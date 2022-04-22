<div class="card">
    <h1 class="title">Create new account</h1>

    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email')->emailField()  ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <?= $form->field($model, 'cpassword')->passwordField() ?>

    <button class="button" type="submit">Register</button>

    <small class="link-btn">Have account please ? <a href="login">Login</a></small>

    <?php Form::end(); ?>

</div>