<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";
require_once __DIR__ . "/../models/RegisterModel.php";

class SiteController extends Controller
{
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
