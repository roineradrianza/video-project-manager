<?php
/*
 * @var method
 * @var query
 */
if (empty($method)) {
    die(403);
}

use Controller\Helper;

use Model\{ProjectVideo, ProjectVideoMeta};

$project_video = new ProjectVideo;
$project_meta = new ProjectVideoMeta;
$helper = new Helper;

$data = json_decode(file_get_contents("php://input"), true);
$query = empty($query) ? 0 : clean_string($query);

switch ($method) {

    case 'get':
        $results = $project_video->get(project_id: $query);
        $videos = [];
        foreach ($results as $video) {
            $meta = $project_meta->get($video['project_video_id']);
            $video['meta'] = [];
            foreach ($meta as $i => $e) {
                $video['meta'][$e['meta_name']] = $e['meta_value'];
            }
            $videos[] = $video;
        }
        echo json_encode($videos);
        break;

    case 'create':
        if (!isset($_SESSION['user_type'])) {
            die(403);
        }

        $data = $_POST;

        if (empty($data) || empty($_FILES['video']['tmp_name'])) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $media_data = [ 'name' => clean_string($data['name']), 'project_id' => clean_string($data['project_id']), 'src' => ''];

        $video_file = $_FILES['video'];
        $tmp_video_file = $video_file['tmp_name'];
        $ext = explode(".", $video_file['name']);
        $video_name = "{$helper->convert_slug($ext[0])}-" . time();
        $main_video_name = "$video_name-{$media_data['project_id']}";

        $projects_path = "projects/{$media_data['project_id']}";

        !file_exists(DIRECTORY . "/public/$projects_path") ? mkdir(DIRECTORY . "/public/$projects_path", recursive: true) : '';

        $result = '';

        if (move_uploaded_file($tmp_video_file, DIRECTORY . "/public/$projects_path/$main_video_name.mp4")) {
            set_time_limit(3600);
            $media_data['src'] = "/$projects_path/$main_video_name.mp4";
            $result = $project_video->create($media_data);
            !$result ? $helper->response_message('Error', 'No se ha podido registrar el video, intente de nuevo', 'error') : '';

            $media_data['project_video_id'] = $result;
            $media_data['meta'] = [];
            $ffmpeg = FFMpeg\FFMpeg::create(['timeout' => 25600]);
            $codec = new FFMpeg\Format\Video\X264();
            $video = $ffmpeg->open(DIRECTORY . "/public/$projects_path/$main_video_name.mp4");
            $video
                ->filters()
                ->synchronize();
            foreach ($helper->array_sort($helper->video_resolution(), 'order', SORT_DESC) as $resolution) {

                $temp_path = "$projects_path/$main_video_name-{$resolution['name']}.mp4";
                $absolute_temp_path = DIRECTORY . "/public/$temp_path";
                $codec
                    ->setKiloBitrate($resolution['bitrate']);
                $video
                    ->save($codec, DIRECTORY . "/public/$temp_path");
                if (file_exists($absolute_temp_path)) {

                    $meta_data = [
                        'meta_name' => "video_url_{$resolution['name']}", 
                        'meta_value' => "/$temp_path", 
                        'project_video_id' => $result
                    ];

                    $project_meta->create($meta_data) ? $media_data['meta'][$meta_data['meta_name']] = $meta_data['meta_value'] : '';
                }
            }

            $helper->response_message('Éxito', 'Video subido éxitosamente', data: ['project_video_id' => $result,'meta' => $media_data]);
        } 

        $helper->response_message('Error', 'No se pudo subir el video, intente de nuevo', 'error');

        break;

    case 'update':
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $data = sanitize($data);
        $result = $project_video->edit($data['project_video_id'], sanitize($data));
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido editar la información, intente nuevamente.', 'error');
        }

        $helper->response_message('Éxito', 'Se editó el nombre correctamente');
        break;
    
    case 'delete':
        $result = $project_video->delete($query);
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido eliminar el video, intente de nuevo.', 'error');
        }

        $helper->response_message('Éxito', 'Se ha eliminado el video correctamente');
        break;

}