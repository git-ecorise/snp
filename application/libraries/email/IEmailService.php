<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'ISignUpEmailInput.php';
require_once 'IResetPasswordEmailInput.php';

interface IEmailService
{
    public function send_signup_email(ISignUpEmailInput $input);
    public function send_reset_password_email(IResetPasswordEmailInput $input);
}

?>
