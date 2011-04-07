<?php
    $template_model->title = 'Login';
?>

<h1>Login</h1>
<form action="<?= login_route() ?>" method="post">
    <div class="input">
        <label>Email</label><br/>
        <input type="text" name="email" value="" />
        <br />
    </div>
    <div class="input">
        <label>Password</label><br/>
        <input type="password" name="password" value="" />
        <br />
    </div>
    <div class="input-submit">
        <input type="submit" value="Login" />
    </div>
</form>