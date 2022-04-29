<div class="wrapper">
    <?php if (App::isGuest()) : ?>

        <section class="users">
            <header>
                <div class="content">
                    <svg width="50" height="50" version="1.1" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <style id="current-color-scheme" type="text/css">
                                .ColorScheme-Text {
                                    color: #dedede;
                                }
                            </style>
                        </defs>
                        <g fill="#dedede" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="paint-order:stroke fill markers" aria-label="">
                            <path d="m10.391 9.3984q1.0625 0.36719 1.9141 1.0313 0.85938 0.65625 1.4531 1.5234 0.60156 0.86719 0.92188 1.8984 0.32031 1.0312 0.32031 2.1484h-1q0-1.2812-0.46094-2.375-0.45312-1.1016-1.2578-1.9062-0.80469-0.80469-1.9062-1.2578-1.0938-0.46094-2.375-0.46094-0.83594 0-1.6094 0.21094-0.77344 0.21094-1.4453 0.60156-0.66406 0.38281-1.2109 0.92969-0.53906 0.53906-0.92969 1.2109-0.38281 0.66406-0.59375 1.4375-0.21094 0.77344-0.21094 1.6094h-1q0-1.125 0.32812-2.1484 0.32812-1.0312 0.92969-1.8906t1.4531-1.5156q0.85938-0.65625 1.9141-1.0391-0.60938-0.32812-1.0938-0.79688t-0.82812-1.0391q-0.33594-0.57812-0.52344-1.2266-0.17969-0.65625-0.17969-1.3438 0-1.0391 0.39062-1.9453 0.39062-0.91406 1.0703-1.5938t1.5859-1.0703q0.91406-0.39062 1.9531-0.39062t1.9453 0.39062q0.91406 0.39062 1.5938 1.0703 0.67969 0.67969 1.0703 1.5938 0.39062 0.90625 0.39062 1.9453 0 0.6875-0.1875 1.3359-0.17969 0.64844-0.52344 1.2188-0.33594 0.57031-0.82031 1.0469-0.47656 0.46875-1.0781 0.79688zm-6.3906-4.3984q0 0.82812 0.3125 1.5547 0.32031 0.72656 0.85938 1.2734 0.54688 0.53906 1.2734 0.85938 0.72656 0.3125 1.5547 0.3125t1.5547-0.3125q0.72656-0.32031 1.2656-0.85938 0.54688-0.54688 0.85938-1.2734 0.32031-0.72656 0.32031-1.5547t-0.32031-1.5547q-0.3125-0.72656-0.85938-1.2656-0.53906-0.54688-1.2656-0.85938-0.72656-0.32031-1.5547-0.32031t-1.5547 0.32031q-0.72656 0.3125-1.2734 0.85938-0.53906 0.53906-0.85938 1.2656-0.3125 0.72656-0.3125 1.5547z" stroke-width="2" />
                        </g>
                    </svg>
                    <div class="details">
                        <a href="/profile" class="profile">
                            <span><?= App::$app->user->getDisplayName(); ?></span>
                        </a>
                        <p><?= App::$app->user->status; ?></p>
                    </div>
                </div>
                <form action="" method="POST">
                    <input class="cari" name="logout" id="cari" type="hidden">
                    <button class="button logout" type="submit">logout</button>
                </form>
            </header>

            <div class="search">
                <form action="" method="POST" autocomplete="off">
                    <label class="text" for="cari">Select an user to start chat</label>
                    <input class="cari" name="cari" id="cari" type="text" placeholder="Enter name to search..." autofocus>
                    <button class="btn-cari" id="btn-cari">Search</button>
                </form>
            </div>

            <div class="users-list">
                <script src="/js/users.js"></script>
            </div>
        </section>

    <?php endif; ?>
</div>