<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat-App</title>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Css -->
    <?php if (App::$app->controller->action === 'profile' || App::$app->controller->action === 'edit' || App::$app->controller->action === 'setting') : ?>
        <link rel="stylesheet" href="/css/profile.css">
        <link rel="stylesheet" href="/css/edit.css">
    <?php else : ?>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/home.css">
    <?php endif; ?>

</head>

<body>

    <?php if (App::$app->session->getFlash('success')) : ?>
        <div class="flash">
            <span class="fls-txt"><?= App::$app->session->getFlash('success'); ?></span>
        </div>
    <?php endif; ?>

    {{content}}

    <?php if (App::$app->controller->action === 'home') : ?>
        <script src="/js/users.js"></script>
    <?php elseif (App::$app->controller->action === 'edit') : ?>
        <script src="/js/edit.js"></script>
    <?php elseif (App::$app->controller->action === 'chat') : ?>
        <script src="/js/chat-box.js"></script>
    <?php else : ?>
        <script src=""></script>
    <?php endif; ?>
</body>

</html>