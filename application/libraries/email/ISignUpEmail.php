<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface ISignUpEmail
{
    public function get_email();
    public function get_validationcode();
}

?>