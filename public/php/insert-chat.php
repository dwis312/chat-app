<?php


include_once __DIR__ . '/../../core/App.php';
include_once __DIR__ . '/../../core/Request.php';
include_once __DIR__ . '/../../app/models/ChatModel.php';
require_once __DIR__ . "/../../config/config.php";

$config = [
    'userClass' => Users::class,
    'db' => [
        'dns' => DB_DNS,
        'user' => DB_USER,
        'password' => DB_PASSWORD,
    ]
];

$q = $_SERVER["HTTP_REFERER"];
$q = explode('/', $q);
$q = explode('=', $q[3]);

$incoming_id = $q[1];

$app = new App(dirname(__DIR__), $config);

$request = new Request();
$message = new ChatModel();
$message->loadData($request->getData());

$message::updateChat([
    'incoming_msg_id' => $incoming_id,
    'outgoing_msg_id' => App::$app->user->unique_id,
    'msg' => $request->getData($_POST['msg'])["msg"],
]);
