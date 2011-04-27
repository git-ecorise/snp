<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface ISignUpEmailInput
{
    public function get_email();
    public function get_validationcode();
}

?>