<?php
    $template_model->set_title('Login');
?>

<h1>Login</h1>

<form action="<?= login_route() ?>" method="post">
    <div class="input">
        <label>Email</label>
        <input type="text" name="email" value="<?= set_value('email')?>" />
        <?= form_error('email'); ?>
    </div>
    <div class="input">
        <label>Password</label>
        <input type="password" name="password" value="" />
        <?= form_error('password'); ?>
    </div>
    <p><a href="<?=reset_password_route()?>" class="forgot_password">Forgot your password?</a></p>
    <div class="input-submit">
        <input type="submit" value="Login" />
    </div>
</form>