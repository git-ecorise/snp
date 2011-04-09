<?php
    $template_model->set_title('Sign up');
?>

<h1>Sign up</h1>

<form action="<?= signup_route() ?>" method="post">
    <div class="input">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?= set_value('email')?>"/>
        <?= form_error('email'); ?>
    </div>
    <div class="input">
        <label for="password">Password:</label>
        <input type="password" name="password" value=""/>
        <?= form_error('password'); ?>
    </div>
    <div class="input">
        <label for="paswordconfirm">Confirm password:</label>
        <input type="password" name="passwordconfirm" value=""/>
        <?= form_error('passwordconfirm'); ?>
    </div>
    <div class="input">
        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" value="<?= set_value('firstname')?>"/>
        <?= form_error('firstname'); ?>
    </div>
    <div class="input">
        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" value="<?= set_value('lastname')?>"/>
        <?= form_error('lastname'); ?>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Sign up"/>
    </div>
</form>