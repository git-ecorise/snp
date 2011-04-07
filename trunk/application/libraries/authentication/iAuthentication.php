<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUser.php';

interface iAuthentication
{
    public function login(iUser $user);
    public function logout();
    public function get_user();
}

?>
