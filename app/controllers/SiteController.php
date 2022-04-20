<?php

require_once dirname(dirname(__DIR__)) . "/core/Controller.php";
require_once dirname(dirname(__DIR__)) . "/core/Request.php";
require_once dirname(dirname(__DIR__)) . "/app/models/Users.php";
require_once dirname(dirname(__DIR__)) . "/app/models/LoginModel.php";
require_once dirname(dirname(__DIR__)) . "/core/form/Form.php";
require_once dirname(dirname(__DIR__)) . "/core/form/Field.php";

class SiteController extends Controller
{
    public function home()
    {
        $this->setLayout('main');
        return $this->render('home');
    }

    public function register(Request $request)
    {
        $user = new Users();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->register()) {
                App::$app->session->setFlash('success', 'Thanks for registering');
                App::$app->response->redirect('/login');
                exit;
            }

            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login(Request $request, Response $response)
    {
        $login = new LoginModel();

        if ($request->post()) {
            $login->loadData($request->getData());

            if ($login->valiadate() && $login->login()) {
                App::$app->session->setFlash('success', "Welcome back $login->usename");
                $response->redirect('/');
                return;
            }

            $this->setLayout('auth');
            return $this->render('login', [
                'model' => $login
            ]);
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $login
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        App::$app->logout();
        $response->redirect('/login');
    }
}
