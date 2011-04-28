<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/InputBase.php');
require_once 'IResetPasswordInput.php';

class ResetPasswordInput extends InputBase implements IResetPasswordInput
{
    // Private fields
    private $email;
    private $resetcode;

    function __construct()
    {
        parent::__construct('resetpassword');

        $this->load->helper('crypto');

        // Load data
        $this->email = $this->input->post('email');
    }

    // Getter and Setters

    public function get_email()
    {
        return $this->email;
    }

    public function get_resetcode()
    {
        return $this->resetcode != null ? $this->resetcode : ($this->resetcode = generate_randomcode(20));
    }
}

?>