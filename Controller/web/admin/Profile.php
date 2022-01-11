<?php

use Controller\Template;

class Profile extends Controller\Routes
{

    public function initView()
    {
        $this->scripts = [
            ['name' => 'admin/profile.min', 'version' => '1.0.0'],
        ];
        $this->content = new Template("admin/profile");
        $this->title = 'Perfil';

        $this->render();
    }
}
