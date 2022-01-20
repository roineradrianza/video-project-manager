<?php
namespace Model;

use Model\Helper\DB;

/**
 * Project Video Model
 */

class ProjectVideo extends DB
{
    private $table = "project_videos";
    private $id_column = "project_video_id";
    private $id_project_column = "project_id";

    public function get($id = 0, $project_id = 0) : Array
    {
        if (!empty($project_id)) {
            $sql = "SELECT * FROM {$this->table} WHERE {$this->id_project_column} = $project_id";
        } elseif (!empty($id)) {
            $sql = "SELECT * FROM {$this->table} WHERE {$this->id_column} = $id";
        } else {
            $sql = "SELECT * FROM {$this->table}";
        }
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

        $sql = "INSERT INTO {$this->table} (name, src, project_id) VALUES('$name', '$src', $project_id)";
        $result = $this->execute_query_return_id($sql);
        return $result;
    }

    public function edit($id, $data = []) : Bool
    {
        if (empty($data) or empty($id)) {
            return false;
        }

        extract($data);
        $sql = "UPDATE {$this->table} SET name = '$name' WHERE {$this->id_column} = $id;";
        $result = $this->execute_query($sql);
        return $result;
    }

    public function delete($id) : Bool
    {
        if (empty($id)) {
            return false;
        }

        $sql = "DELETE FROM {$this->table} WHERE {$this->id_column} = $id;";
        $result = $this->execute_query($sql);
        return $result;
    }

}
