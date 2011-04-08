<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserCreate.php';

class UserCreate extends CI_Model implements iUserCreate
{
    // private fields
    //var $email;
    //var $password;
    //var $passwordConfirm;
    //var $firstname;
    //var $lastname;
    
    function __construct()
    {
        parent::__construct();

        // Load data
        //$this->email = $this->input->post('email');
        //$this->password = $this->input->post('password');
        //$this->password = $this->input->post('passwordConfirm');
        //$this->firstname = $this->input->post('firstname');
        //$this->lastname = $this->input->post('lastname');

    }

    // iValidatable interface
    public function validate()
    {
        return $this->form_validation->run('signup') != FALSE;

        // Callback to if email is available / unique



        
        //$result = new ValidationResult();
        //return $result;
    }

    // Getter and Setters

    public function get_email()
    {
        return $this->email = $this->input->post('email');
        //return $this->email;
    }

    public function get_password()
    {
        return $this->password = $this->input->post('password');
        return $this->password;
    }

    public function get_firstname()
    {
        return $this->firstname = $this->input->post('firstname');
        //return $this->firstname;
    }

    public function get_lastname()
    {
        return $this->lastname = $this->input->post('lastname');
        //return $this->lastname;
    }
}

?>
