<?php

$outgoing_id = App::$app->user->unique_id;

?>

<div class="wrapper">

    <?php if (App::isGuest()) : ?>

        <section class="chat-area">
            <header>
                <a href="/"><span class="arrow"></span></a>
                <img src="#" alt="">
                <div class="details">
                    <span><?= $user["username"]; ?></span>
                    <p><?= $user["status"]; ?></p>
                </div>
            </header>

            <div class="chat-box">

            </div>

            <form action="" method="POST" class="typing-area" autocomplete="off">
                <input type="text" name="msg" class="msg" id="msg" placeholder="Type a message here...">
                <button type="submit">Send</button>
            </form>

        </section>


    <?php endif; ?>
</div>