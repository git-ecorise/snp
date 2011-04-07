<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'UserCreate.php';
require_once 'UserLogin.php';

interface iUserService
{
    public function create(UserCreate $create);
    public function authenticate(UserLogin $login);
    //public function validate(UserActivate $activation);
}

?>
