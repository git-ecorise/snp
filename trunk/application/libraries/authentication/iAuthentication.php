<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iIdentity.php';

interface iAuthentication
{
    public function login(iIdentity $identity);
    public function logout();
    public function get_user();
}

?>
