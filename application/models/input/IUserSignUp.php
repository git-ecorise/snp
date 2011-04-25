<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'libraries/IValidatable.php');

interface IUserSignUp extends IValidatable
{
    public function set_id($id);

    public function get_id();
    public function get_email();
    public function get_passwordhash();
    public function get_passwordsalt();
    public function get_firstname();
    public function get_lastname();
    public function get_activationcode();   // validationcode ?
}

?>