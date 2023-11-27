<?php


class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // Controller
        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
            // If exists, set as controller
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1])) {
            // If exists, set as method
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Params
        if (!empty($url)) {
            // If exists, set as params
            $this->params = array_values($url);
        }

        // Run controller, method, and params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            // Remove trailing slash
            $url = rtrim($_GET['url'], '/');
            // Sanitize URL
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Break URL into array
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}

?>