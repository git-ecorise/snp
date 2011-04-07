<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iValidatable.php';

interface iUserCreate extends iValidatable
{
    public function get_email();
    public function get_password();
    public function get_firstname();
    public function get_lastname();
}

?>
