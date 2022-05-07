<?php

require_once __DIR__ . "/../../config/config.php";
require_once __DIR__ . "/../../app/models/Users.php";
require_once dirname(dirname(__DIR__)) . '/core/App.php';


$config = [
    'userClass' => Users::class,
    'db' => [
        'dns' => DB_DNS,
        'user' => DB_USER,
        'password' => DB_PASSWORD,
    ]
];

$users = new App(dirname(__DIR__), $config);
$users = App::$app->users();

?>

<?php if (empty($users)) : ?>
    <div class="notfound">
        <p>username is not exist</p>
    </div>
<?php else : ?>
    <?php foreach ($users as $user) : ?>
        <?php include_once __DIR__ . "/data.php"; ?>
    <?php endforeach; ?>
<?php endif; ?>