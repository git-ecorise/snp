<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUser.php';

interface IAuthenticationService
{
    public function login(IUser $user);
    public function logout();
    public function get_user();
}

?>
