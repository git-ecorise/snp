<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserLogin.php';
require_once(APPPATH . 'libraries/validation/ValidationResult.php');

// Model is pretty much unneeded now when doing it the new way

class UserLogin extends CI_Model implements iUserLogin
{
    // private fields
    //var $email;
    //var $password;
    
    function __construct()
    {
        parent::__construct();

        // Load data
        //$this->email = $this->input->post('email');
        //$this->password = $this->input->post('password');
    }

    // iValidatable interface
    public function validate()
    {
        // Change to is_valid !

        // Remove validationResult and serviceResult !?
        
        return $this->form_validation->run('login') != FALSE;


        // add callback ? just check here if the login is correct ?




        //$result = new ValidationResult();
        //return $result;
    }

    // Getter and Setters
    
    public function get_email()
    {
        // escape ?
        
        return $this->email = $this->input->post('email');
        //return $this->email;
    }

    public function get_password()
    {
        // escape

        return $this->password = $this->input->post('password');
        //return $this->password;
    }
}

?>
