<?php

require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";
require_once __DIR__ . "/View.php";
require_once __DIR__ . "/Controller.php";

class App
{

    public static string $ROOT_DIR;
    public static App $app;

    public Route $route;
    public Request $request;
    public Response $response;
    public View $view;
    public Controller $controller;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->view = new View();
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
    }

    public function run()
    {
        echo $this->route->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}
