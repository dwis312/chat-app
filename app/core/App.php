<?php

require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";

class App
{

    public Route $route;
    public Request $request;
    public Response $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Route($this->request, $this->response);
    }

    public function run()
    {
        $this->route->resolve();
    }
}
