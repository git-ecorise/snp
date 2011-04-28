<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IUser
{
    public function is_authenticated();
    public function is_admin();

    public function get_id();
    public function get_email();
    public function get_firstname();
    public function get_lastname();
    public function get_fullname();
    public function has_image();
}

?>
