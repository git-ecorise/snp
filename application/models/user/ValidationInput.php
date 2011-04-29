<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/InputBase.php');
require_once 'IValidationInput.php';

class ValidationInput extends InputBase implements IValidationInput
{
    // Private fields
    private $email;
    private $code;

    function __construct()
    {
        parent::__construct('validate');

        // Load data
        $this->email = $this->input->post('email');
        $this->code = $this->input->post('validationcode');
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_validationcode()
    {
        return $this->code;
    }
}

?>