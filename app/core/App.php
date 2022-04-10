<?php

require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/Request.php";

class App
{

    public Route $route;
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->route = new Route($this->request);
    }

    public function run()
    {
        $this->route->resolve();
    }
}
