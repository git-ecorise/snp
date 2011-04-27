<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'InputModel.php';
require_once 'IUserLogin.php';

// verify password here ? or go into service ? verify_credentials(ICredentials)

class UserLogin extends InputModel implements IUserLogin
{
    // private fields
    private $email;
    private $password;

    function __construct()
    {
        parent::__construct('login');

        $this->load->helper('crypto');

        // Load input data
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
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
