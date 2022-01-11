<?php

use Controller\Template;

class Login extends Controller\Routes
{

    public function initView()
    {
        $this->is_logged ? header("Location: " . $_SESSION['redirect_url']) : '';
        $this->header = false;
        $this->scripts = [
            ['name' => 'login', 'version' => '1.0.0'],
        ];
        $this->footer = false;
        $this->title = 'Iniciar Sesión';
        $this->content = new Template("login");

        $this->render();
    }
}
