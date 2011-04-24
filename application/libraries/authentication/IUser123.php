<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IUser
{
    public function is_authenticated();
    public function get_id();
    public function get_email();
    public function get_firstname();
    public function get_lastname();
    public function get_fullname();

    // is_admin eller lignende ? is_in_role ? create helpers for checkin the different roles.
    // Create enum like using constants etc.
}

?>
