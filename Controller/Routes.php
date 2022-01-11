<?php
namespace Controller;

/**
 * Routes Web/Api Handler
 */
class Routes
{
    public $title = PROJECT_NAME;
    public $admin = false;
    public $content;
    public $header = true;
    public $description;
    public $admin_header = false;
    public $footer = false;
    public $styles = [];
    public $scripts = [];
    protected $is_logged = false;

    public function __construct($render = false)
    {
        $render ? $this->init() : '';
    }

    public function init()
    {
        $this->is_logged = !empty($_SESSION['user_id']);
        $route = explode("/", $_SERVER['REQUEST_URI']);
        array_shift($route);
        if ($route[0] == "api") {
            $controller = $route[1];
            if (!empty($controller)) {
                $method = isset($route[2]) ? $route[2] : '';
                $query = isset($route[3]) ? $route[3] : '';
                require DIRECTORY . "/Controller/api/" . $controller . ".php";
            }
        } else {
            $dir = DIRECTORY . "/Controller/web/";
            $Class = Helper::convert_first_letter_uppercase(end($route));
            $pages_args = [
                'article' => empty($route[1]) ? '' : $route[1],
            ];
            $args = [];
            switch (count($route)) {
                case 1:
                    $Class = empty($Class) ? 'Home' : $Class;
                    $controller_route = "$dir$Class.php";
                    $this->render_web_404($controller_route);
                    require $controller_route;

                    $init = method_exists($Class, 'initView');
                    if ($init) {
                        $view = new $Class;
                        $view->initView($args);
                    } else {
                        new $Class();
                    }
                    break;

                case 2:
                    if (empty($route[1]) || str_contains($route[1], '?')) {
                        $Class = Helper::convert_first_letter_uppercase($route[0]);
                        $controller_route = "$dir/$Class.php";
                        $this->render_web_404($controller_route);
                        require $controller_route;
                    } else {
                        if (!empty($pages_args[$route[0]])) {
                            $Class = Helper::convert_first_letter_uppercase($route[0]);
                            $args['query'] = $route[1];
                            $controller_route = "$dir$Class.php";
                        } else {
                            $controller_route = "$dir$route[0]/$Class.php";
                        }
                        $this->render_web_404($controller_route);
                        require $controller_route;
                    }
                    $init = method_exists($Class, 'initView');
                    if ($init) {
                        $view = new $Class;
                        $view->initView($args);
                    } else {
                        new $Class();
                    }
                    break;

                case 3:
                    if (empty($route[2])) {
                        $Class = Helper::convert_first_letter_uppercase($route[1]);
                        $controller_route = "$dir$route[0]/$Class.php";
                        $this->render_web_404($controller_route);
                        require $controller_route;
                    } else {
                        $controller_route = "$dir$route[0]/$route[1]/$Class.php";
                        $this->render_web_404($controller_route);
                        require $controller_route;
                    }
                    $init = method_exists($Class, 'initView');
                    if ($init) {
                        $view = new $Class;
                        $view->initView($args);
                    } else {
                        new $Class();
                    }
                    break;

                default:
                    $this->render_web_404('');
                    break;
            }
        }
    }

    public function render_web_404($directory = '')
    {
        if (!file_exists($directory) || empty($directory)) {
            $this->header = false;
            $this->footer = false;
            $this->styles = [['name' => 'login']];
            $this->scripts = [['name' => 'errors/404.min']];
            $this->content = new Template('errors/404');
            $this->title = 'Página no encontrada';
            $this->render();
            exit();
        }
    }
    public function render()
    {
        $view = new Template("app", [
            "title" => $this->title,
            "content" => $this->content,
            "header" => $this->header,
            "admin_header" => $this->admin_header,
            "styles" => $this->styles,
            "scripts" => $this->scripts,
            "footer" => $this->footer,
        ]);
        echo $view;
    }
}