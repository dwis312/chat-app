<?php

require_once dirname(dirname(__DIR__)) . "/core/Controller.php";
require_once dirname(dirname(__DIR__)) . "/core/Request.php";
require_once dirname(dirname(__DIR__)) . "/app/models/Users.php";
require_once dirname(dirname(__DIR__)) . "/app/models/ProfileModel.php";
require_once dirname(dirname(__DIR__)) . "/app/models/LoginModel.php";
require_once dirname(dirname(__DIR__)) . "/app/models/ChatModel.php";
require_once dirname(dirname(__DIR__)) . "/app/models/Forgot.php";
require_once dirname(dirname(__DIR__)) . "/app/models/Reset_password.php";
require_once dirname(dirname(__DIR__)) . "/core/form/Form.php";
require_once dirname(dirname(__DIR__)) . "/core/form/BaseFiled.php";
require_once dirname(dirname(__DIR__)) . "/core/form/InputField.php";
require_once dirname(dirname(__DIR__)) . "/core/middlewares/BaseMiddleware.php";
require_once dirname(dirname(__DIR__)) . "/core/middlewares/AuthMiddleware.php";

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
        $this->registerMiddleware(new AuthMiddleware(['chat']));
    }

    public function home(Request $request, Response $response)
    {

        if (!App::isGuest()) $response->redirect('/login');
        $users = App::$app->userList();

        if ($request->post() && !empty($_POST["cari"])) {
            $users = DbModel::cari($_POST["cari"]);

            $this->setLayout('main');
            return $this->render('home', ['users' => $users]);
        } elseif ($request->post() && empty($_POST["logout"]) && !isset($_POST["cari"])) {
            $this->logout($request, $response);
        }


        $this->setLayout('main');
        return $this->render('home', ['users' => $users]);
    }

    public function register(Request $request)
    {
        if (App::$app->user) throw new ForbiddenException();
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
        if (App::$app->user) throw new ForbiddenException();

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

    public function forgot(Request $request, Response $response)
    {
        $user = new Forgot();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->cekEmail()) {
                App::$app->session->setFlash('success', 'Validate email success');
                App::$app->response->redirect('/reset_password');
                exit;
            }

            $this->setLayout('auth');
            return $this->render('forgot', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('forgot', [
            'model' => $user
        ]);
    }

    public function reset_password(Request $request, Response $response)
    {
        $user = new Reset_password();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->reset()) {
                App::$app->session->setFlash('success', 'Change password success');
                App::$app->response->redirect('/login');
                exit;
            }

            $this->setLayout('auth');
            return $this->render('reset_password', [
                'model' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('reset_password', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        $logout = new Users();

        if ($request->post()) {
            $logout->loadData($request->getData());

            if ($logout->logout()) {
                App::$app->logout();
                $response->redirect('/login');
            }

            $this->setLayout('main');
            return $this->render('home');
        }
    }

    public function profile()
    {
        $user = new ProfileModel();

        return $this->render('profile', [
            'model' => $user->userProfile()
        ]);
    }

    public function edit(Request $request, Response $response)
    {
        $user = new ProfileModel();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->edit()) {
                $response->redirect('/profile');
                exit;
            }

            return $this->render('edit', [
                'model' => $user
            ]);
        }

        return $this->render('edit', [
            'model' => $user->userProfile()
        ]);
    }

    public function setting(Request $request, Response $response)
    {
        $user =  new Users();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->settingUser()) {
                $response->redirect('/../profile');
                exit;
            }

            return $this->render('setting', [
                'model' => $user
            ]);
        }

        return $this->render('setting', [
            'model' => App::isGuest()
        ]);
    }

    public function chat(Request $request, Response $response)
    {
        if (!App::isGuest()) $response->redirect('/');
        $chatMessage = new ChatModel();
        if ($request->get()) {
            $user = Users::getUser($request->getData());
            if (!$user) throw new ForbiddenException;

            $this->setLayout('main');
            return $this->render('chat', [
                'user' => $user,
                'message' => $chatMessage->getChat()
            ]);
        }

        if ($request->post()) {
            $chatMessage->loadData($request->getData());

            if ($chatMessage->insertChat()) {
                $response->redirect('/chat');
            }

            $this->setLayout('main');
            return $this->render('chat', [
                'user' => Users::getUser($_GET),
                'message' => $chatMessage->getChat()
            ]);
        }
    }
}
