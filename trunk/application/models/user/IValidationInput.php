<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/IValidatable.php');

interface IValidationInput extends IValidatable
{
    public function get_email();
    public function get_validationcode();
}

?>