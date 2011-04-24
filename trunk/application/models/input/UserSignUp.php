<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserSignUp.php';
require_once 'InputModel.php';

// UserSignUpModel / iUserSignUpModel ?

// Some of the logic can be moved into a service and then make this model a plain data carrier ?
// But it is really not needed ... dont over engineer this ....


// Should it have the iUser interface ? then it can actually be used to authenticate with later on if wanted ?
// But who cares ?



class UserSignUp extends InputModel implements IUserSignUp
{
    private $id = null;
    private $salt = null;

    function __construct()
    {
        parent::__construct('signup');

        $this->load->helper('crypto');

        // Load input here ? after validation have taken place ?
        // only if valid ?
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
        return $this->input->post('email');
    }

    public function get_passwordhash()
    {      
        // escape ? xss clean ?
        // Generate new on every call or just cache it ? could be different depending if it is called before or after validate() !?

        // Store the result or calculate everytime called ?

        $clearpassword = $this->input->post('password');
        $salt = get_salt();
        $hashedpassword = generate_hash($clearpassword, $salt);

        return $hashedpassword;
    }

    public function get_salt()
    {
        // Check this works in PHP like in C#
        
        return $this->salt == null ? ($this->salt = $this->generate_salt()) : $this->salt;
    }

    public function get_firstname()
    {
        return $this->input->post('firstname');
    }

    public function get_lastname()
    {
        return $this->input->post('lastname');
    }





    // Kan databasen evt bruges til direkte at opdaterer db med ? eller skal der laves nogle db models til det? UserInsert / UserCreate / CreateUser lignende models ?
    // Eller helt drop det og map denne model til db i db laget.

    
    
    // Ret Database så alle fields er korrekt + tilføj max length til validerings checks ?

    // Password = xx chars ?
    // Salt = xx chars ?
    // ValidationCode = 32 chars ?


    // Skal stadigvæk bruge en helper til at validerer password med ? is_valid_credentials ? verify_credentials ? 

}

?>
