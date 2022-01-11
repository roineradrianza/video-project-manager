<?php

namespace Controller;

/**
 *
 */
class Template
{
    private $content;
    
    public function __construct($path, $data = [])
    {
        extract($data);
        ob_start();
        include __DIR__ . "/../Views/$path.php";
        $this->content = ob_get_clean();
    }

    public function __toString()
    {
        return $this->content;
    }

    public static function admin_menu_tabs()
    {
        $tabs = ['tabs' => [
            ['name' => 'Proyectos', 'icon' => 'mdi-dock-window', 'url' => 'projects'],
            ['name' => 'Usuarios', 'icon' => 'mdi-account-group', 'url' => 'users'],
        ],
        ];
        return $tabs;
    }
}
