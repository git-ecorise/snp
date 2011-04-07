<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iIdentity.php';

class DefaultUser implements iIdentity
{
    function __construct()
    {
    }

    public function is_authenticated()
    {
        return false;
    }

    public function get_id()
    {
        return 0;
    }

    public function get_email()
    {
        return null;
    }

    public function get_firstname()
    {
        return null;
    }

    public function get_lastname()
    {
        return null;
    }

    public function get_fullname()
    {
        return null;
    }
}

?>
