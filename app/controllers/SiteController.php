<?php

require_once dirname(dirname(__DIR__)) . "/core/Controller.php";
require_once dirname(dirname(__DIR__)) . "/core/Request.php";
require_once dirname(dirname(__DIR__)) . "/app/models/RegisterModel.php";
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
        $model = new RegisterModel();

        if ($request->post()) {
            $model->loadData($request->getData());

            if ($model->valiadate()) {
                return "Success";
            }

            $this->setLayout('main');
            return $this->render('register', [
                'model' => $model
            ]);
        }

        $this->setLayout('main');
        return $this->render('register', [
            'model' => $model
        ]);
    }

    public function login()
    {
    }
}
