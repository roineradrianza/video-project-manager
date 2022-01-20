<?php
namespace Model;

use Model\Helper\DB;

/**
 * Project Video Meta Model
 */

class ProjectVideoMeta extends DB
{
    private $table = "project_video_meta";
    private $id_column = "meta_id";
    private $video_column = "project_video_id";

    public function get(int $id = 0) : Array
    {
        if ($id == 0) {
            return false;
        }

        $sql = "SELECT meta_name, meta_value FROM {$this->table} WHERE {$this->video_column} = $id";
        $result = $this->execute_query($sql);
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function create($data = []) : Mixed
    {
        if (empty($data)) {
            return false;
        }

        extract($data);
        
        $sql = "INSERT INTO {$this->table} (meta_name, meta_value, project_video_id) VALUES('$meta_name', '$meta_value', $project_video_id)";
        $result = $this->execute_query_return_id($sql);
        return $result;
    }

    public function get_meta(int $project_video_id = 0, $meta_name = '') : Array
    {
        if (empty($meta_name) || empty($project_video_id)) {
            return [];
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$this->video_column} = $project_video_id AND meta_name = '$meta_name'";
        $result = $this->execute_query($sql);
        if (empty($result)) {
            return [];
        }
        return $result->fetch_assoc();
    }

    public function edit($id, $data = []) : Bool
    {
        if (empty($data) or empty($id)) {
            return false;
        }

        extract($data);
        $sql = "UPDATE {$this->table} SET meta_value = '$meta_value' WHERE {$this->id_column} = $id AND meta_name = '$meta_name'";
        $result = $this->execute_query($sql);
        return $result;
    }

    public function delete($id) : Bool
    {
        if (empty($id)) {
            return false;
        }

        $sql = "DELETE FROM {$this->table} WHERE {$this->id_column} = $id";
        $result = $this->execute_query($sql);
        return $result;
    }

}
