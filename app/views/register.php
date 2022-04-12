<div class="card">
    <h1 class="title">Create new account</h1>

    <form class="form-control" action="" method="POST" autocomplete="off">
        <div class="field">
            <input class="form-input <?= $model->hasError('username') ? 'is-invalid' : ''; ?>" type="text" name="username" id="username" placeholder=" " value="<?= $model->username; ?>">
            <label class="form-label" for="username">Username</label>
            <div class="invalid-feedback <?= $model->hasError('username') ? 'show' : ''; ?>">
                <span class="error-icon">!!!</span>
                <small class="error-message"><?= $model->getError('username'); ?></small>
            </div>
        </div>

        <div class="field">
            <input class="form-input <?= $model->hasError('email') ? 'is-invalid' : ''; ?>" type="email" name="email" id="email" placeholder=" " value="<?= $model->email; ?>">
            <label class="form-label" for="email">Email</label>
            <div class="invalid-feedback <?= $model->hasError('email') ? 'show' : ''; ?>">
                <span class="error-icon">!!!</span>
                <small class="error-message"><?= $model->getError('email'); ?></small>
            </div>
        </div>

        <div class="field">
            <input class="form-input <?= $model->hasError('password') ? 'is-invalid' : ''; ?>" type="password" name="password" id="password" placeholder=" ">
            <label class="form-label" for="password">Password</label>
            <div class="invalid-feedback <?= $model->hasError('password') ? 'show' : ''; ?>">
                <span class="error-icon">!!!</span>
                <small class="error-message"><?= $model->getError('password'); ?></small>
            </div>
        </div>

        <div class="field">
            <input class="form-input <?= $model->hasError('cpassword') ? 'is-invalid' : ''; ?>" type="password" name="cpassword" id="cpassword" placeholder=" ">
            <label class="form-label" for="cpassword">Confirm Password</label>
            <div class="invalid-feedback <?= $model->hasError('cpassword') ? 'show' : ''; ?>">
                <span class="error-icon">!!!</span>
                <small class="error-message"><?= $model->getError('cpassword'); ?></small>
            </div>
        </div>

        <button type="submit">Register</button>

    </form>
</div>