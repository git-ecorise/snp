<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iUserService
{
    public function create(UserCreate $create);             // User ?
    public function authenticate(UserLogin $login);
    public function validate(UserActivate $activation);
}

?>
