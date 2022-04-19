<?php

require_once dirname(dirname(__DIR__)) . "/core/Controller.php";
require_once dirname(dirname(__DIR__)) . "/core/Request.php";
require_once dirname(dirname(__DIR__)) . "/app/models/Users.php";
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
                App::$app->response->redirect('/');
                exit;
            }

            $this->setLayout('main');
            return $this->render('register', [
                'model' => $user
            ]);
        }

        $this->setLayout('main');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login()
    {
    }
}
