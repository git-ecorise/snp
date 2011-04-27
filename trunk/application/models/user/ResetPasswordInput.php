<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/InputBase.php');

//require_once 'IResetPasswordInput.php';

class ResetPasswordInput extends InputBase /* implements IResetPasswordInput*/
{
    // Private fields

    function __construct()
    {
        parent::__construct('resetpassword');        // <--- RET - skal ikke sende this med -... gælder også andre models ?!?!!?!??! sådan som det er nu ... tjek InputBase

        $this->load->helper('crypto');

        // Load data
        $this->email = $this->input->post('email');

    }

    // Getter and Setters

    public function get_email()
    {
        return $this->email;
    }

    public function get_validationcode()
    {
        return $this->validationcode != null ? $this->validationcode : ($this->validationcode = generate_randomcode(20));
    }
}

?>