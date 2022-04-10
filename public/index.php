<?php

require_once __DIR__ . "/../app/core/App.php";
require_once __DIR__ . "/../app/controllers/SiteController.php";

Route::get('/', 'home');

$app = new App();
$app->run();
