<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iValidatable.php';

interface iUserLogin extends iValidatable
{
    public function get_email();
    public function get_password();
}

?>