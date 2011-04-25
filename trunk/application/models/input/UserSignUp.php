<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserSignUp.php';
require_once 'InputModel.php';

// UserSignUpModel / IUserSignUpModel ?



// Some of the logic can be moved into a service and then make this model a plain data carrier ?
// But it is really not needed ... dont over engineer this ....


// Should it have the iUser interface ? then it can actually be used to authenticate with later on if wanted ?
// But who cares ?








    // Kan databasen evt bruges til direkte at opdaterer db med ? eller skal der laves nogle db models til det? UserInsert / UserCreate / CreateUser lignende models ?
    // Eller helt drop det og map denne model til db i db laget.

    
    
    // Ret Database så alle fields er korrekt + tilføj max length til validerings checks ?

    // Password = xx chars ?
    // Salt = xx chars ?
    // ValidationCode = 32 chars ?


    // Skal stadigvæk bruge en helper til at validerer password med ? is_valid_credentials ? verify_credentials ?





// Change database 


// escape ? xss clean ?

class UserSignUp extends InputModel implements IUserSignUp
{
    // Private fields
    private $id = null;
    private $passwordsalt = null;
    private $passwordhash = null;
    private $activationcode = null;

    private $email;
    private $password;
    private $firstname;
    private $lastname;
    
    function __construct()
    {
        parent::__construct('signup');

        $this->load->helper('crypto');

        // Load data
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
        $this->firstname = $this->input->post('firstname');
        $this->lastname = $this->input->post('lastname');
    }

    // Getter and Setters
    
    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_passwordhash()
    {
        return $this->passwordhash != null ? $this->passwordhash : ($this->passwordhash = generate_hash($this->password, $this->get_passwordsalt()));
    }

    public function get_passwordsalt()
    { 
        return $this->passwordsalt != null ? $this->passwordsalt : ($this->passwordsalt = generate_salt());
    }

    public function get_firstname()
    {
        return $this->firstname;
    }

    public function get_lastname()
    {
        return $this->lastname;
    }

    public function get_activationcode()
    {
        return $this->activationcode != null ? $this->activationcode : ($this->activationcode = generate_randomcode());
    }
}

?>
