<?php
    $template_model->title = 'Create user';
?>

<h1>Sign Up</h1>

<form action="<?= createuser_route() ?>" method="post">
    <div class="input">
        <label for="email">Email:</label><br/><input type="text" name="email" value=""/><br/>
    </div>
    <div class="input">
        <label for="password">Password:</label><br/><input type="password" name="password" value=""/><br/>
    </div>
    <div class="input">
        <label for="paswordConfirm">Confirm password:</label><br/><input type="password" name="password" value=""/><br/>
    </div>
    <div class="input">
        <label for="firstname">First name:</label><br/><input type="text" name="firstname" value=""/><br/>
    </div>
    <div class="input">
        <label for="lastname">Last name:</label><br/><input type="text" name="lastname" value=""/><br/>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Create user"/><br/>
    </div>
</form>