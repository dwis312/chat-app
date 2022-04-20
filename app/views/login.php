<div class="card">
    <h1 class="title">Welcome back</h1>

    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordField() ?>
    <button class="button" type="submit">Login</button>

    <?php Form::end(); ?>

</div>