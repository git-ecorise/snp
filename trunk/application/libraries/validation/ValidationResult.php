<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iValidationResult.php';

class ValidationResult implements iValidationResult
{
    // private fields
    var $errors = array();

    function __construct($errors = array())
    {
        $this->add_errors($errors);
    }

    public function is_valid()
    {
        return count($this->errors) == 0;
    }

    public function get_errors()
    {
       return $this->errors;
    }

    public function add_error(String $key, String $value)
    {
        $this->errors[$key] = $value; // Allow to override errors already added/set?
    }

    public function add_errors(Array $errors)
    {
        $this->errors = array_merge($this->errors, $errors);   // Allows to override already set errors - switch to not allow ?
    }
}

?>
