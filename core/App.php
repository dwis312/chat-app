<?php

require_once __DIR__ . "/Session.php";
require_once __DIR__ . "/Route.php";
require_once __DIR__ . "/Request.php";
require_once __DIR__ . "/Response.php";
require_once __DIR__ . "/View.php";
require_once __DIR__ . "/DbModel.php";
require_once __DIR__ . "/UserModel.php";
require_once __DIR__ . "/../app/models/Users.php";
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/../db/Database.php";
require_once __DIR__ . "/../db/Migrations.php";

class App
{

    public static string $ROOT_DIR;
    public static App $app;
    public string $userClass;
    public string $layout = 'main';

    public Route $route;
    public Request $request;
    public Response $response;
    public Session $session;
    public View $view;
    public ?UserModel $user;
    public ?Controller $controller = null;
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

        if (!empty($primaryValue)) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try {
            echo $this->route->resolve();
        } catch (\Exception $e) {
            $this->response->getStatusCode($e->getCode());
            echo $this->view->renderView('_error', ['e' => $e]);
        }
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

    public function login(UserModel $user)
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

    public function userList()
    {
        $user = $this->userClass::getAll(['unique_id' => $this->user->unique_id]);
        return $user;
    }

    public function users()
    {
        $user = $this->userClass::cari($_GET['username']);
        return $user;
    }
}
