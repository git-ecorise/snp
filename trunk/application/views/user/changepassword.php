<?php
    $template_model->set_title('Change password');
?>

<h1>Change password</h1>

<form action="<?= change_password_route() ?>" method="post">
    <div class="input">
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?= set_value('email')?>"/>
        <?= form_error('email'); ?>
    </div>
    <div class="input">
        <label for="password">New password:</label>
        <input type="password" name="password" value=""/>
        <?= form_error('password'); ?>
    </div>
    <div class="input">
        <label for="paswordconfirm">Confirm new password:</label>
        <input type="password" name="passwordconfirm" value=""/>
        <?= form_error('passwordconfirm'); ?>
    </div>
    <div class="input">
        <label for="resetcode">Reset code:</label>
        <input type="text" name="resetcode" value="<?= set_value('resetcode')?>"/>
        <?= form_error('resetcode'); ?>
    </div>
    <div class="input-submit">
        <input type="submit" name="submit" value="Change password"/>
    </div>
</form>