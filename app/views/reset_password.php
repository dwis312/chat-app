<div class="card">
    <h1 class="title forgot">Reset Password</h1>


    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'password')->passwordField() ?>
    <?= $form->field($model, 'cpassword')->passwordField() ?>

    <button class="button forgot-btn" type="submit">Reset password</button>

    <small class="link-btn">Back to <a href="login">Login</a></small>

    <?php Form::end(); ?>
</div>