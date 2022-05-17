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

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getPath();
        $url = trim($url, '/');
        // $url = explode('/', $url);
        // $routes = $this->routeMap[$method] ?? [];
        $routes = self::$routes[$method] ?? [];
        $routeParams = false;

        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);
                $this->request->setRouteParams($routeParams);

                if ($routeParams['id'] === App::isGuest()->unique_id) return $callback;
                if ($routeParams['username'] === App::isGuest()->username) return $callback;
            }
        }

        return false;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = self::$routes[$method][$path] ?? false;

        if (!$callback) {
            $callback = $this->getCallback();

            if ($callback === false) {
                throw new NotFoundException();
            }
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
