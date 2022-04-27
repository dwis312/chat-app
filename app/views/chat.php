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

            </div>

            <form action="" method="POST" class="typing-area">
                <input type="text" name="msg" id="" placeholder="Type a message here...">
                <button type="submit">Send</button>
            </form>
        </section>


    <?php endif; ?>
</div>