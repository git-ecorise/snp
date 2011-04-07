<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iUser
{
    public function is_authenticated();
    public function get_id();
    public function get_email();
    public function get_firstname();
    public function get_lastname();
    public function get_fullname();
}

?>
