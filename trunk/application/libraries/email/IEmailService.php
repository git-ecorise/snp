<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/input/IUserSignUp.php');

interface IEmailService
{
    public function send_signup_email(IUserSignUp $user);

    //public function send_reset_password_email();
}

?>
