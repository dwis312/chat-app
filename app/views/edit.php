<main class="container section">
    <div class="header">
        <a href="/../profile"><i class="bx bx-chevron-left"></i></a>
        <h1 class="title">Edit Profile</h1>
    </div>

    <form class="form-control" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="field-img">
            <label class="label-img" for="img">
                <div class="img <?= ($model->hasError('photo')) ? 'is-invalid' : ''; ?>">
                    <img class="imgPreview" src="/img/<?= $model->photo; ?>" alt="img">
                </div>
            </label>
            <span class="feedback <?= ($model->hasError('photo')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('photo'); ?></small></span>
            <input class="input-img" type="file" name="photo" id="img" onchange="viewImg()">
        </div>

        <div class="field">
            <span class="text-label">Name</span>
            <div class="bx">
                <input class="input name" type="text" name="name" id="name" value="<?= $model->name; ?>">
                <label class="label name" for="name"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('name')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('name'); ?></small></span>
        </div>

        <div class="field">
            <span class="text-label">Profesi</span>
            <div class="bx">
                <input class="input profesi" type="text" name="profesi" id="profesi" value="<?= $model->profesi; ?>">
                <label class="label profesi" for="profesi"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('profesi')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('profesi'); ?></small></span>
        </div>

        <div class="field">
            <span class="text-label">City</span>
            <div class="bx">
                <input class="input city" type="text" name="city" id="city" value="<?= $model->city; ?>">
                <label class="label city" for="city"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('city')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('city'); ?></small></span>
        </div>

        <div class="field">
            <span class="text-label">Phone</span>
            <div class="bx">
                <input class="input phone" type="text" name="phone" id="phone" value="<?= $model->phone; ?>">
                <label class="label phone" for="phone"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('phone')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('phone'); ?></small></span>
        </div>

        <button type="submit">save</button>

    </form>
</main>