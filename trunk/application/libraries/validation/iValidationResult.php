<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iValidationResult
{
    public function is_valid();
    public function get_errors();
    public function add_error(String $key, String $value);
    public function add_errors(Array $errors);
}

?>
