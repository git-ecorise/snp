<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'models/iUserCreate.php');
require_once(APPPATH . 'models/iUserLogin.php');

interface iUserService
{
    public function create(iUserCreate $create);
    public function authenticate(iUserLogin $login);
    //public function validate(UserActivate $activation);
}

?>
