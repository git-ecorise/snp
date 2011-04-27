<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/IValidatable.php');

interface ISignUpInput extends IValidatable
{
    public function get_email();
    public function get_password();
    public function get_firstname();
    public function get_lastname();
    public function get_validationcode();
}

?>