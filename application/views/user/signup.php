<?php
    $template_model->title = 'Sign up';
?>

<h1>Sign up</h1>

<?= validation_errors() ?>

<form action="<?= signup_route() ?>" method="post">
    <div class="input">
        <label for="email">Email:</label>
        <br/>
        <input type="text" name="email" value="<?= set_value('email')?>"/>
    </div>
    <div class="input">
        <label for="password">Password:</label>
        <br/>
        <input type="password" name="password" value=""/>
    </div>
    <div class="input">
        <label for="paswordConfirm">Confirm password:</label>
        <br/>
        <input type="password" name="password" value=""/>
    </div>
    <div class="input">
        <label for="firstname">First name:</label>
        <br/>
        <input type="text" name="firstname" value="<?= set_value('firstname')?>"/>
    </div>
    <div class="input">
        <label for="lastname">Last name:</label>
        <br/>
        <input type="text" name="lastname" value="<?= set_value('lastname')?>"/>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Sign up"/>
    </div>
</form>