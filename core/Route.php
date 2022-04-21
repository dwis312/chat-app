<?php

require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/exception/NotFoundException.php";

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
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return App::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            App::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}
