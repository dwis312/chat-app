<?php

require_once __DIR__ . "/core/App.php";
require_once __DIR__ . "/app/controllers/SiteController.php";
require_once __DIR__ . "/config/config.php";


$config = [
    'db' => [
        'dns' => DB_DNS,
        'user' => DB_USER,
        'password' => DB_PASSWORD,
    ]
];

$app = new App(__DIR__, $config);
$app->migrations();
