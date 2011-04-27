<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IUserSignUpInput
{
    public function get_email();
    public function get_password();
    public function get_firstname();
    public function get_lastname();
    public function get_validationcode();
}

?>