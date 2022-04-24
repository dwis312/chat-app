<div class="wrapper">

    <?php if (App::isGuest()) : ?>

        <section class="chat-area">
            <header>
                <a href="/"><span class="arrow"></span></a>
                <img src="#" alt="">
                <div class="details">
                    <span><?= $user; ?></span>
                    <p>Active now</p>
                </div>
            </header>

            <div class="chat-box">

                <?php for ($i = 0; $i <= 10; $i++) : ?>
                    <div class="chat outgoing">
                        <div class="details">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, doloribus.</p>
                        </div>
                    </div>

                    <div class="chat incoming">
                        <img src="" alt="">
                        <div class="details">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, doloribus.</p>
                        </div>
                    </div>

                <?php endfor; ?>

            </div>

            <form action="" class="typing-area">
                <input type="text" name="" id="" placeholder="Type a message here...">
                <button type="submit">Send</button>
            </form>
        </section>


    <?php endif; ?>
</div>