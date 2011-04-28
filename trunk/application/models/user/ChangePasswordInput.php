<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/InputBase.php');
require_once 'IChangePasswordInput.php';

class ChangePasswordInput extends InputBase implements IChangePasswordInput
{
    // Private fields
    private $email;
    private $password;
    private $resetcode;

    function __construct()
    {
        parent::__construct('changepassword');

        $this->load->helper('crypto');

        // Load data
        $this->email = $this->input->post('email');
        $this->password = $this->input->post('password');
        $this->resetcode = $this->input->post('resetcode');
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

    public function get_resetcode()
    {
        return $this->resetcode;
    }
}

?>
