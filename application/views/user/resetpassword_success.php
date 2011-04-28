<?
    $template_model->set_title('Reset Password - Success');
?>

<h1>Password reset code have been sent by email</h1>
<div>
    We have sent you an email with the reset code needed to reset your password.
    <br />
    <a href="<?= change_password_route() ?>">Click here</a> to go to the reset page or click the link in the email to automatically reset the password.
</div>