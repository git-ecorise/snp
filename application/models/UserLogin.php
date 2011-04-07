<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserLogin.php';
require_once(APPPATH . 'libraries/validation/ValidationResult.php');

class UserLogin extends CI_Model implements iUserLogin
{
    // private fields
    var $email;
    var $password;
    
    function __construct()
    {
        parent::__construct();

        // Load data
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
    }

    // iValidatable interface
    public function validate()
    {
        $result = new ValidationResult();

        // Do the validation...

        // Get data - by email
        // if found check password is correct

        return $result;
    }

    // Getter and Setters
    
    public function get_email()
    {
        return $this->email;
    }

    public function get_password()
    {
        return $this->password;
    }
}

?>
