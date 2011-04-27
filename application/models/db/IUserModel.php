<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserValidationInput.php';
require_once 'IUserSignUpInput.php';

// IUserRepository
// All inputs bliver til IUserSignUpInput ? 

interface IUserModel
{
    public function create(IUserSignUpInput $input);
    public function validate(IUserValidationInput $input);

    public function get_by_email($email);
    public function get_all_by_name($name);


    // Add missing methods needed - But doesnt really make sense as it is not injected anywhere ?
    // Would have to create some UserService that could have the UserModel injected ?
}

?>