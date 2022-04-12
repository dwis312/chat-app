<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../core/Request.php";

class SiteController extends Controller
{
    public function register(Request $request)
    {
        if ($request->post()) {
            echo ('<pre>');
            var_dump($_POST);
            echo ('</pre>');
            exit();
        }
        return $this->render('register');
    }

    public function login()
    {
    }
}
