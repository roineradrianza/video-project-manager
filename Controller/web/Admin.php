<?php

use Controller\Template;

class Admin extends Controller\Routes
{

    public function initView()
    {
        $this->styles = [['name' => 'admin/dashboard.min']];
        $this->scripts = [
            ['name' => 'Classes/Project.min'],
            ['name' => 'admin/projects.min']
        ];
        $this->content = new Template("admin/projects");
        $this->title = 'Administración - Dashboard';

        $this->render();
    }
}
