<?php

require_once __DIR__ . "/Session.php";
require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";
require_once __DIR__ . "/View.php";
require_once __DIR__ . "/DbModel.php";
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../db/Database.php";
require_once __DIR__ . "/../db/Migrations.php";

class App
{

    public static string $ROOT_DIR;
    public static App $app;
    public string $userClass;

    public Route $route;
    public Request $request;
    public Response $response;
    public Session $session;
    public View $view;
    public ?DbModel $user;
    public Controller $controller;
    public Migrations $migrations;

    public Database $db;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->userClass = $config['userClass'];
        $this->migrations = new Migrations();
        $this->view = new View();
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->route = new Route($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
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

    public function migrations()
    {
        $this->migrations->applyMigrations();
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return self::$app->user;
    }
}
