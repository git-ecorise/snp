<?
    $template_model->set_title('Reset Password');
?>

<h1>Reset Password</h1>
<div>
    Enter your email below and we will send you an email with further instructions of how to reset your password.
</div>

<form action="<?= reset_password_route() ?>" method="post">
    <div class="input">
        <label>Email</label>
        <input type="text" name="email" value="<?= set_value('email')?>" />
        <?= form_error('email'); ?>
    </div>
    <div class="input-submit">
        <input type="submit" value="Reset" />
    </div>
</form>

<a href="<?= change_password_route() ?>">Already have a reset code?</a>
