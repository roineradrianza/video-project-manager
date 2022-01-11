<?php
/*
 * @var method
 * @var query
 */
if (empty($method)) {
    die(403);
}


use Model\Project;

use Controller\Helper;

$project = new Project;
$helper = new Helper;

$data = json_decode(file_get_contents("php://input"), true);
$query = empty($query) ? 0 : clean_string($query);

switch ($method) {

    case 'get':
        $results = $project->get($query);
        echo json_encode($results);
        break;

    case 'create':
        if (!isset($_SESSION['user_type'])) {
            die(403);
        }
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $result = $project->create(sanitize($data));

        if (!$result) {
            $helper->response_message('Error', 'No se ha podido procesar la solicitud', 'error');
        }
    
        $helper->response_message('Éxito', 'Proyecto registrado éxitosamente', data:['project_id' => $result]);
        break;

    case 'update':
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $id = intval($data['project_id']);
        $result = $project->edit($id, sanitize($data));
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido editar la información, intente nuevamente.', 'error');
        }

        $helper->response_message('Éxito', 'Se editó el proyecto correctamente');
        break;

    case 'delete':
        $result = $project->delete($query);
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido eliminar el proyecto, intente de nuevo.', 'error');
        }

        $helper->response_message('Éxito', 'Se ha eliminado el proyecto correctamente');
        break;

}
