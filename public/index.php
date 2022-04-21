<?php

require_once __DIR__ . "/../core/App.php";
require_once __DIR__ . "/../app/controllers/SiteController.php";
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../app/models/Users.php";


Route::get('/', [SiteController::class, 'home']);

Route::get('/register', [SiteController::class, 'register']);

Route::post('/register', [SiteController::class, 'register']);

Route::get('/login', [SiteController::class, 'login']);

Route::post('/login', [SiteController::class, 'login']);

Route::get('/logout', [SiteController::class, 'logout']);

Route::get('/profile', [SiteController::class, 'profile']);

$config = [
    'userClass' => Users::class,
    'db' => [
        'dns' => DB_DNS,
        'user' => DB_USER,
        'password' => DB_PASSWORD,
    ]
];

$app = new App(dirname(__DIR__), $config);
$app->run();
