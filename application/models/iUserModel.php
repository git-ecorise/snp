<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iUserModel
{
    public function get_by_email($email);
    public function insert($user);
    public function validate($code);
    public function get_all_by_name($name);
}

?>