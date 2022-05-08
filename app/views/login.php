<div class="card">
    <h1 class="title">Welcome back</h1>

    <?php $form = Form::begin('', "post"); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordField() ?>

    <button class="button" type="submit">Login</button>

    <small class="link-btn">Forgot password? <a href="forgot">here</a></small>
    <small class="link-btn">Not yet signed up? <a href="register">Signup now</a></small>

    <?php Form::end(); ?>

</div>


<div class="footer">
    <!-- <p class="footer__copy">&#169; <a href="https://github.com/dwis312" target="_blank">Dwi Susilo.</a> All right reserved.</p> -->
    <p class="footer__copy">&#169; <a href="https://wa.me/6285155147995" target="_blank">Dwi Susilo.</a> All right reserved.</p>
</div>