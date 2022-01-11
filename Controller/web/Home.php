<?php

use Controller\Template;

class Home extends Controller\Routes
{

    public function initView()
    {
        if (!$this->is_logged) {
            header("Location: " . SITE_URL . "/login");
        } else if (!$this->is_logged && !$this->is_user_type('administrador')) {
            header("Location: " . SITE_URL . "/admin/");
        }
    }
}
