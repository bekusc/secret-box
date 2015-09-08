<?php namespace core;

class Router
{
    private $routes = [];
    private $data = [];

    public function add($url, $action) {
        $this->routes[$url] = $action;
    }

    public function dispatch() {

        $server_url = substr($_SERVER['REQUEST_URI'], 1);
        $server_url = strlen($server_url) ? array_filter(explode('/', $server_url)) : [];

        foreach ($this->routes as $url => $action) {
            
            if($this->url_maches($url, $server_url)) {

                if (is_callable($action)) return $action();

                $action = explode('@', $action);
                $controller = 'app\\controllers\\'.$action[0];
                $method = $action[1];

                return call_user_func_array([new $controller, $method], $this->data);
            }
        }

        Redirect::to(404);
    }

    private function url_maches($url, $server_url) {

        $url = ltrim($url, '/');
        $url = strlen($url) ? explode('/', $url) : [];
        $count = count($server_url);

        if ($count === count($url)) {
            $data = [];
            for ($i=0; $i < $count; $i++) {
                if ($url[$i][0] == ':') {
                    $data[] = $server_url[$i];
                }
                elseif ($url[$i] !== $server_url[$i]) {
                    return false;
                }
            }

            $this->data = $data;
            return true;
            
        }

        return false;
    }
}