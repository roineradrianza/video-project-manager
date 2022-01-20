<?php

use Controller\Template;

class Admin extends Controller\Routes
{

    public function initView()
    {
        $this->styles = [['name' => 'admin/dashboard.min']];
        $this->scripts = [
            ['name' => 'lib/vue-clipboard.min', 'version' => '1.0.1'],
            ['name' => 'Classes/ProjectVideo.min', 'version' => '1.0.1'],
            ['name' => 'Classes/Project.min', 'version' => '1.0.1'],
            ['name' => 'admin/projects.min', 'version' => '1.0.1']
        ];
        $this->content = new Template("admin/projects");
        $this->title = 'Administración - Dashboard';

        $this->render();
    }
}
