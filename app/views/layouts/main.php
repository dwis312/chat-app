<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat-App</title>

    <!-- Css -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/home.css">

</head>

<body>

    <?php if (App::$app->session->getFlash('success')) : ?>
        <div class="flash">
            <span class="fls-txt"><?= App::$app->session->getFlash('success'); ?></span>
        </div>
    <?php endif; ?>

    {{content}}

    <script src="/js/home.js"></script>
</body>

</html>