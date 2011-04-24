<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/input/IUserSignUp.php');

interface IUserModel
{
    public function get_by_email($email);
    public function insert(IUserSignUp $signup);
    public function validate($code);
    public function get_all_by_name($name);
}

?>