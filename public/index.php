<?php

require_once __DIR__ . "/../app/core/App.php";
require_once __DIR__ . "/../app/controllers/SiteController.php";


Route::get('/', 'home');

Route::get('/register', [SiteController::class, 'register']);

Route::post('/register', [SiteController::class, 'register']);

Route::get('/login', [SiteController::class, 'login']);

Route::post('/login', [SiteController::class, 'login']);



$app = new App(dirname(__DIR__));
$app->run();
