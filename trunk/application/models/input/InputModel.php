<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'libraries/IValidatable.php');

abstract class InputModel extends CI_Model implements IValidatable
{
    private $isvalid = false;

    function __construct($validationschema)
    {
        // Call base constructor
        parent::__construct();

        // Set delimiters
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

        // Run Validation immediately before input is loaded - because input data can also be modified in the validation process.
        $this->isvalid = $this->form_validation->run($validationschema) == TRUE;
    }

    public function is_valid()
    {
        return $this->isvalid;
    }
}

?>
