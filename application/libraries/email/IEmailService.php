<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'ISignUpEmail.php';
require_once 'IResetPasswordEmail.php';

interface IEmailService
{
    public function send_signup_email(ISignUpEmail $input);
    public function send_reset_password_email(IResetPasswordEmail $input);
}

?>
