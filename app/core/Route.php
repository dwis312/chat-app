<?php

require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";

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
            return require_once __DIR__ . "/../views/$callback.php";
        }

        call_user_func($callback);
    }
}
