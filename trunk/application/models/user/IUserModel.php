<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IValidationInput.php';
require_once 'ISignUpInput.php';
require_once 'IResetPasswordInput.php';
require_once 'IChangePasswordInput.php';

interface IUserModel
{
    public function create(ISignUpInput $input);
    public function validate(IValidationInput $input);

    public function reset_password(IResetPasswordInput $input);
    public function change_password(IChangePasswordInput $input);

    public function get_by_email($email);
    public function get_all_by_name($name);
}

?>