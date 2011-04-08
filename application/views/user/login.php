<?php
    $template_model->title = 'Login';
?>

<h1>Login</h1>

<?= validation_errors() ?>

<form action="<?= login_route() ?>" method="post">
    <div class="input">
        <label>Email</label><br/>
        <input type="text" name="email" value="<?= set_value('email')?>" />
    </div>
    <div class="input">
        <label>Password</label><br/>
        <input type="password" name="password" value="" />
    </div>
    <div class="input-submit">
        <input type="submit" value="Login" />
    </div>
</form>