<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iUserModel
{
    //public function get_by_id($id);
    public function get_by_email($email);
    public function create($user);
}

?>
