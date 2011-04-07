<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iIdentity
{
    public function is_authenticated();
    public function get_email();
    public function get_firstname();
    public function get_lastname();
    public function get_fullname();
}

?>
