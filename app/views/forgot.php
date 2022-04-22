<div class="card">
    <h1 class="title forgot">Forgot Password</h1>


    <p class="txt-msg">Enter your user account's verified email address and we will send you a password reset link.</p>
    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'email')->emailField() ?>

    <button class="button forgot-btn" type="submit">Send password reset email</button>

    <small class="link-btn">Back to <a href="login">Login</a></small>

    <?php Form::end(); ?>
</div>