<div class="card">
    <h1 class="title">Welcome back</h1>

    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <button class="button" type="submit">Login</button>

    <small class="link-btn">Forgot password ? <a href="forgot">here</a></small>
    <small class="link-btn">No have account please ? <a href="register">Register</a></small>

    <?php Form::end(); ?>

</div>