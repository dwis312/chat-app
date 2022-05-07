<div class="card">
    <h1 class="title">Create new account</h1>

    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email')->emailField()  ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <?= $form->field($model, 'cpassword')->cpasswordField() ?>

    <button class="button" type="submit">Register</button>

    <small class="link-btn">Already signed up? <a href="login">Login now</a></small>

    <?php Form::end(); ?>

</div>