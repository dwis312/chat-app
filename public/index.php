<?php

require_once __DIR__ . "/../core/App.php";
require_once __DIR__ . "/../app/routing/web.php";
require_once __DIR__ . "/../app/controllers/SiteController.php";
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../app/models/Users.php";


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
