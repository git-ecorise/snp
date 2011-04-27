<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/db/IUserSignUpInput.php');
require_once 'InputModel.php';




// Change database
    // Password = xx chars ?
    // Salt = xx chars ?
    // ValidationCode = 32 chars ?
    // Validation / Activation goes into seperate table ? register time of validation / activation ?


class UserSignUp extends InputModel implements IUserSignUpInput
{
    // Private fields
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $validationcode = null;
    
    function __construct()
    {
        parent::__construct('signup', $this);

        $this->load->helper('crypto');

        // Load data
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
        $this->firstname = $this->input->post('firstname');
        $this->lastname = $this->input->post('lastname');
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
    
    public function get_firstname()
    {
        return $this->firstname;
    }

    public function get_lastname()
    {
        return $this->lastname;
    }

    public function get_validationcode()
    {
        return $this->validationcode != null ? $this->validationcode : ($this->validationcode = generate_randomcode(20));
    }
}

?>
