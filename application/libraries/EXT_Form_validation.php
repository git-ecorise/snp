<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Any way to move this into a extensions folder ?


// make possible to execute callback somewhere else than in the controller
// maybe pass in "$this" for the object / instance to use for the callback


// http://www.haloweb.co.uk/blog/2009/03/codeigniter-custom-errors-using-the-form-validation-class/
// http://codeigniter.com/wiki/Custom_Validation_Errors_per_Field/

class EXT_Form_validation extends CI_Form_validation
{
    function __construct($config = array())
    {        
        parent::__construct($config);
    }


    // Authentication

    // Authorization ... ? forskellen ?

    // Identification ?



    // override Run og execute ?

    // hvis null så kald metode på ingenting
    // ellers så kald på det der sendes - CI (=controller) eller model osv ...


    // Pass this or something else to the Run() function and have callbacks called on that object ...

    // Copy over the execute feature to the  EXT_Form_Validation and make the change !






    

    function has_errors()
    {
        // has_errors ? is_valid?

        return !empty($this->_error_array);
        //return count($this_error_array) > 0;
    }

    function contains_error($key)
    {
        return isset ($this->_error_array[$key]);
    }

    function add_error($key, $error)
    {
        // set_error
        // Accept array ?
        // Check parameters ?

        $this->_error_array[$key] = $error;
    }
}

?>
