<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/db/IUserValidationInput.php');
require_once 'InputModel.php';




// Rename all to have INPUT AS SUFFIX ?



// UserValidationInput

// Rename Db til DB ?

// UserDB ? eller Repository ?
// UserRepository ?
// IUserRepository ?

// Rename InputModel til InputBase ? BaseInput ?

class UserValidation extends InputModel implements IUserValidationInput
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