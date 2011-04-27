<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IEmailService
{
    public function send_signup_email($email, $code);
    public function send_reset_password_email($email, $code);
}

?>
