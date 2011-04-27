<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IResetPasswordEmail
{
    public function get_email();
    public function get_password_reset_code();
}

?>