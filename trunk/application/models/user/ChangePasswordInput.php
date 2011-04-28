<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/InputBase.php');
require_once 'IChangePasswordInput.php';

class ChangePasswordInput extends InputBase implements IChangePasswordInput
{
    // Private fields
    private $email;
    private $password;
    private $resetcode = null;

    function __construct()
    {
        parent::__construct('changepassword');

        $this->load->helper('crypto');

        // Load data
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


    
    // Lav i UserModel istedet og brug get/set ?

    public function get_resetcode()
    {
        return $this->resetcode != null ? $this->resetcode : ($this->resetcode = generate_randomcode(20));
    }
}

?>
