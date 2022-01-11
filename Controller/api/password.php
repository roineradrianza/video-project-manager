<?php
/*
 *    @var method
 * @var query
 */
if (empty($method)) {
    die(403);
}

use Controller\{Helper, Template};
use Model\Member;

$member = new Member;
$helper = new Helper;

$data = json_decode(file_get_contents("php://input"), true);
$query = empty($query) ? 0 : clean_string($query);

switch ($method) {

    case 'request-reset':
        if (empty($data['email'])) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $email = clean_string($data['email']);
        if (!$member->check_exist_credential($email)) {
            $helper->response_message('Advertencia', 'No hay usuarios registrados con una dirección de correo electrónico', 'warning');
        }

        $reset_code = $helper->rand_string(5) . time();
        $member->set_reset_code($email, $reset_code);
        $template_data = ['reset_code' => $reset_code];
        $template = new Template('email-templates/recover-password', $template_data);
        $sendEmail = $helper->send_mail('Solicitud de restablecimiento de contraseña', [['email' => $email, 'full_name' => '']], $template);
        if (!$sendEmail) {
            $helper->response_message('Error', 'No se ha podido enviar el correo electrónico de restablecimiento, inténtalo de nuevo', 'error');
        }

        $helper->response_message('Éxito', 'Se ha enviado un mensaje a su dirección de correo electrónico para proceder al restablecimiento de la contraseña.', 'success');
        break;

    case 'reset':
        if (empty($query)) {
            $helper->response_message('Advertencia', 'No se ha recibido información', 'warning');
        }

        $reset_code = clean_string($query);
        if (!$member->check_exist_reset_code($reset_code)) {
            $helper->response_message('Error', 'No hay ningún usuario asociado al código de restablecimiento, vuelva a solicitar uno nuevo.', 'error');
        }

        $result = $member->reset_password(clean_string($data['password']), $reset_code);
        if (!$result) {
            $helper->response_message('Error', 'No se ha podido establecer la nueva contraseña, inténtelo de nuevo.', 'error');
        }

        $helper->response_message('Éxito', 'Tu contraseña ha sido restablecida con éxito, serás redirigido a la página de acceso en unos momentos...', 'success');
        break;

}