<!-- MAIN -->
<main class="container section">
    <div class="header">
        <a href="/"><i class="bx bx-chevron-left"></i></a>
        <h1 class="title">Profile</h1>
    </div>

    <div class="card">
        <div class="img">
            <img src="img/<?= $model->photo; ?>" alt="img">
        </div>

        <div class="card-body">
            <h2 class="title-name"><?= $model->name; ?></h2>
            <h3 class="title-prof"><?= $model->profesi; ?></h3>

            <div class="wrapper">
                <a class="editBtn" href="/profile/edit/<?= $model->unique_id; ?>/<?= App::isGuest()->username; ?>">
                    <i class='bx bxs-pencil'></i>
                    Edit Profile
                </a>

                <a class="settingBtn" href="/profile/setting/<?= $model->unique_id; ?>/<?= App::isGuest()->username; ?>">
                    <i class='bx bx-cog'></i>
                </a>

                <div class="desc">
                    <div class="city">
                        <i class='bx bx-map'></i>
                        <small><?= $model->city; ?></small>
                    </div>
                    <div class="tel">
                        <i class='bx bx-phone'></i>
                        <small><?= $model->phone; ?></small>
                    </div>
                    <div class="email">
                        <i class='bx bxl-gmail'></i>
                        <small><?= App::isGuest()->email; ?></small>
                    </div>
                    <div class="join">
                        <i class='bx bx-calendar'></i>
                        <small>Joined on <?= $model->create_at; ?></small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>