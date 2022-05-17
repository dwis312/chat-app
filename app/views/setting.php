<main class="container section">
    <div class="header">
        <a href="/../profile"><i class="bx bx-chevron-left"></i></a>
        <h1 class="title">Setting Acount</h1>
    </div>

    <form class="form-control" action="" method="POST" autocomplete="off">

        <div class="field">
            <span class="text-label">Username</span>
            <div class="bx">
                <input class="input username" type="text" name="username" id="username" value="<?= $model->username; ?>">
                <label class="label username" for="username"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('username')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('username'); ?></small></span>
        </div>

        <div class="field">
            <span class="text-label">Email</span>
            <div class="bx">
                <input class="input email" type="email" name="email" id="email" value="<?= $model->email; ?>">
                <label class="label email" for="email"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('email')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('email'); ?></small></span>
        </div>

        <div class="field">
            <h4 class="text-label">Change Password</h4>
        </div>

        <div class="field">
            <span class="text-label">Old Password</span>
            <div class="bx">
                <input class="input password" type="password" name="oldPassword" id="oldpassword" value="" placeholder="Your old password">
                <label class="label password" for="oldpassword"><i class='bx bxs-pencil'></i></label>
            </div>
        </div>

        <div class="field">
            <span class="text-label">New Password</span>
            <div class="bx">
                <input class="input password" type="password" name="password" id="password" value="" placeholder="New password">
                <label class="label password" for="password"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('password')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('password'); ?></small></span>
        </div>

        <div class="field">
            <span class="text-label">Confirm new Password</span>
            <div class="bx">
                <input class="input cpassword" type="password" name="cpassword" id="cpassword" value="" placeholder="Confirm password">
                <label class="label cpassword" for="cpassword"><i class='bx bxs-pencil'></i></label>
            </div>
            <span class="feedback <?= ($model->hasError('cpassword')) ? 'is-invalid' : ''; ?>"><small><?= $model->getError('cpassword'); ?></small></span>
        </div>

        <button type="submit">save</button>

    </form>
</main>