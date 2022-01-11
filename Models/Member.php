<?php
namespace Model;

use Model\Helper\DB;

/**
 *
 */

class Member extends DB
{
    private $table = "users";
    private $id_column = "user_id";

    public function get($id = 0, $columns = []) : Array
    {
        $columns = empty($columns) ? '*' : implode(',', $columns);
        if ($id != 0) {
            $sql = "SELECT ${columns} FROM {$this->table} WHERE {$this->id_column} = $id";
        } else {
            $sql = "SELECT ${columns} FROM {$this->table}";
        }
        $result = $this->execute_query($sql);
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function get_by_members() : Array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_type = 'miembro'";
        $result = $this->execute_query($sql);
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function get_by_admins() : Array
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_type = 'administrador'";
        $result = $this->execute_query($sql);
        $arr = [];
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function check_user($email, $password, $encrypt_password = true) : Mixed
    {
        $password = $encrypt_password ? md5($password) : $password;
        $sql = "SELECT * FROM {$this->table} WHERE email = '$email' AND `password` = '$password'";
        $result = $this->execute_query($sql);
        if ($result) {
            return $result->fetch_object();
        }

        return null;
    }

    public function check_exist_credential($email) : Bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = '$email'";
        $result = $this->execute_query($sql);
        if ($result->fetch_object() != null) {
            return true;
        }

        return false;
    }

    public function check_exist_reset_code($reset_code = '') : Bool
    {
        if (empty($reset_code)) {
            return false;
        }

        $sql = "SELECT user_id FROM {$this->table} WHERE reset_code = '$reset_code'";
        $result = $this->execute_query($sql);
        if ($result->fetch_object() != null) {
            return true;
        }

        return false;
    }

    public function set_reset_code($email = '', $reset_code = '') : Bool
    {
        if (empty($reset_code) || empty($email)) {
            return false;
        }

        $sql = "UPDATE {$this->table} SET reset_code = '$reset_code' WHERE email = '$email'";
        $result = $this->execute_query($sql);
        return $result;
    }

    public function create($data = [], $columns = []) : Mixed
    {
        if (empty($data)) {
            return false;
        }

        $columns = implode(',', $columns);
        extract($data);
        $password = md5($password);
        $sql = "INSERT INTO {$this->table} ($columns) VALUES('$first_name', '$last_name', '$email', '$user_type', '$password')";
        $result = $this->execute_query_return_id($sql);
        return $result;
    }

    public function create_just_email($data = []) : Mixed
    {
        if (empty($data)) {
            return false;
        }

        extract($data);
        $password = md5($password);
        $sql = "INSERT INTO {$this->table} (email, first_name, last_name, password) VALUES('$email', '$first_name', '$last_name', '$password')";
        $result = $this->execute_query_return_id($sql);
        return $result;
    }

    public function edit($id, $data = []) : Bool
    {
        if (empty($data) or empty($id)) {
            return false;
        }

        extract($data);
        $user_type = empty($user_type) ? 'miembro' : $user_type;
        $sql = "UPDATE {$this->table} SET first_name = '$first_name', last_name = '$last_name', email = 
        '$email', user_type = '$user_type' WHERE {$this->id_column} = $id;";
        if (isset($data['password'])) {
            $password = md5($password);
            $sql = "UPDATE {$this->table} SET first_name = '$first_name', last_name = '$last_name', email = '$email', 
            user_type = '$user_type', password = '$password' WHERE {$this->id_column} = $id;";
        }
        $result = $this->execute_query($sql);
        return $result;
    }

    public function edit_profile($id, $data = []) : Bool
    {
        if (empty($data) or empty($id)) {
            return false;
        }

        extract($data);
        $sql = "UPDATE {$this->table} SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE {$this->id_column} = $id;";
        if (isset($data['password']) and $data['password'] != "") {
            $password = md5($password);
            $sql = "UPDATE {$this->table} SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password' WHERE {$this->id_column} = $id;";
        }
        $result = $this->execute_query($sql);
        return $result;
    }

    public function edit_password($id = 0, $password = '') : Bool
    {
        if (empty($id) or empty($password)) {
            return false;
        }

        $password = md5($password);
        $sql = "UPDATE {$this->table} SET password = '$password' WHERE {$this->id_column} = $id";
        $result = $this->execute_query($sql);
        return $result;
    }

    public function reset_password($password = '', $reset_code = '') : Bool
    {
        if (empty($password) || empty($reset_code)) {
            return false;
        }

        $password = md5($password);
        $sql = "UPDATE {$this->table} SET password = '$password' WHERE reset_code = '$reset_code'";
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
