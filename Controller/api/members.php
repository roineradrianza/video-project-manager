<?php
/*
 * @var method
 * @var query
 */
if (empty($method)) {
    die(403);
}


use Model\Member;

use Controller\Helper;

$member = new Member;
$helper = new Helper;

$data = json_decode(file_get_contents("php://input"), true);
$query = empty($query) ? 0 : clean_string($query);

switch ($method) {
    case 'get':
        $query = is_numeric($query) ? $query : $helper->decrypt($query);
        $results = $member->get($query, ['user_id', 'first_name', 'last_name', 'user_type', 'email']);
        echo json_encode($results);
        break;

    case 'get-by-members':
        $results = $member->get_by_members();
        echo json_encode($results);
        break;

    case 'search-user':
        $results = $member->search_user(clean_string($query));
        echo json_encode($results);
        break;

    case 'create':
        if (!isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'administrador') {
            die(403);
        }
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $columns = ['first_name', 'last_name', 'email', 'user_type', 'password'];
        $result = $member->create(sanitize($data), $columns);
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido procesar la solicitud', 'error');
        }
    
        $helper->response_message('Éxito', 'Usuario registrado éxitosamente', data:['user_id' => $result]);
        break;

    case 'update':
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        if (!is_numeric($data['user_id'])) {
            $data['user_id'] = Helper::decrypt($data['user_id']);
        }
        $id = intval($data['user_id']);
        $result = $member->edit($id, sanitize($data));
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido editar la información, intente nuevamente.', 'error');
        }

        $helper->response_message('Éxito', 'Se editó el miembro correctamente');
        break;
    case 'sign-in':
        if (empty($data)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $result = null;
        $email = clean_string($data['email']);
        $password = clean_string($data['password']);
        $result = $member->check_user($email, $password);
        if (!empty($result)) {
            //We declare the session variables
            $_SESSION['user_id'] = $result->user_id;
            $_SESSION['first_name'] = $result->first_name;
            $_SESSION['last_name'] = $result->last_name;
            $_SESSION['email'] = $result->email;
            $_SESSION['user_type'] = $result->user_type;
            $_SESSION['redirect_url'] = SITE_URL . '/admin/';
            $cookie_email = $helper->encrypt($_SESSION['email']);
            $cookie_password = $result->password;
            setcookie('u', "$cookie_email", time() + 60 * 60 * 24 * 365, '/');
            setcookie('p', "$cookie_password", time() + 60 * 60 * 24 * 365, '/');
            $_COOKIE['u'] = $cookie_email;
            $_COOKIE['p'] = $cookie_password;
            $helper->response_message('Éxito', 'Ha iniciado sesión, se le redirigirá en un momento.', data: $_SESSION['redirect_url']);
        } else {
            $helper->response_message('Error', 'Las credenciales son incorrectas, verifique e intente de nuevo.', 'error');
        }
        break;

    case 'delete':
        $result = $member->delete(intval($data['user_id']));
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido eliminar el usuario, intente de nuevo.', 'error');
        }

        $helper->response_message('Éxito', 'Se ha eliminado el usuario correctamente');
        break;

    case 'logout':
        //We clean the session variables
        session_unset();
        //Destroy the session
        session_destroy();
        //We redirect the user to the login page
        setcookie('u', "", time() - 1, '/');
        setcookie('p', "", time() - 1, '/');
        header("Location: " . SITE_URL . "/login");
        break;

}
