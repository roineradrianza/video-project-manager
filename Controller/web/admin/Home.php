<?php

use Controller\Template;

class Home extends Controller\Routes
{

    public function initView()
    {
        $this->scripts = [
            ['name' => 'admin/upcm.min']
        ];
        $this->content = new Template("admin/upcm");
        $this->title = 'Administración - Dashboard';

        $this->render();
    }
}
