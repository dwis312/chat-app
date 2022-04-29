<?php

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../app/models/ChatModel.php";
require_once __DIR__ . "/../../core/App.php";

$config = [
    'userClass' => Users::class,
    'db' => [
        'dns' => DB_DNS,
        'user' => DB_USER,
        'password' => DB_PASSWORD,
    ]
];

$app = new App(dirname(__DIR__), $config);

$messages = new ChatModel();
$message = $messages->getChat();

?>

<?php if (empty($message)) : ?>

    <div class="text">
        <p>No messages are available. Once you send message they will appear here.</p>
    </div>
<?php else : ?>
    <?php foreach ($message as $m) : ?>

        <?php if ($m["outgoing_msg_id"] === App::$app->user->unique_id) : ?>

            <div class="chat outgoing">
                <div class="details">
                    <p><?= $m["msg"]; ?></p>
                </div>
            </div>

        <?php else : ?>

            <div class="chat incoming">
                <img src="" alt="">
                <div class="details">
                    <p><?= $m["msg"]; ?></p>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>