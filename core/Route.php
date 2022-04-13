<?php

require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";
require_once __DIR__ . "/Controller.php";

class Route
{

    public Request $request;
    public static array $routes = [];

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = self::$routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->getStatusCode(404);
            echo "404 Not Found";
            exit;
        }

        if (is_string($callback)) {
            return App::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            App::$app->controller = new $callback[0]();
            $callback[0] = App::$app->controller;
        }

        return call_user_func($callback, $this->request);
    }
}
