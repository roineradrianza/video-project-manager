<?php

use Controller\Template;

class Users extends Controller\Routes
{

    public function initView()
    {
        $this->styles = [['name' => 'admin/dashboard.min']];
        $this->scripts = [
            ['name' => 'register-validations'],
            ['name' => 'Classes/User.min', 'version' => '1.0.0'],
            ['name' => 'admin/members.min', 'version' => '1.0.0'],
        ];
        $this->content = new Template("admin/members");
        $this->title = 'Administración - Usuarios';

        $this->render();
    }
}
