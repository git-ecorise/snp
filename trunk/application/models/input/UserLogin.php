<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserLogin.php';

class UserLogin extends InputModel implements IUserLogin
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('crypto');


        // Load input data
    }

    // Getter and Setters

    public function get_email()
    {
        return $this->input->post('email');
    }

    public function get_password()
    {

        // Really shoudlnt return the password as clean text - should be the hashed password ?

        // Put methods on this object to validate if it is valid ???

        
        

        // Create function for verifying credentials ? ???????????????? !!!!!!!!!!!!!!!



        // escape ? xss clean ?
        return $this->input->post('password');
    }
}

?>
