<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IValidatable.php';

abstract class InputBase extends CI_Model implements IValidatable
{
    function __construct($validationgroup)
    {
        // Call base constructor
        parent::__construct();

        // Set delimiters
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');


        

        // Only run validation if validation group is set ?
        // Make possible to disable ? but why would you use it then ?

        // Hent kun data hvis validation returnerer true ? loaddata event ? der kaldes hvis is_valid returnerer true !? 




        // Run Validation immediately before input is loaded
        // Because input data can also be modified in the validation process.
        $this->form_validation->run($validationgroup);
    }
    
    public function is_valid()
    {
        // Use "global" has_errors incase custom validation have been run
        return !$this->form_validation->has_errors();
    }
}

?>
