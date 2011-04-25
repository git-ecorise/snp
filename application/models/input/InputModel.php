<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'libraries/IValidatable.php');




// lad validation rules blive sat op her i klassen  ? ved at loade fra en static fil eller noget - constants ?
// Kunne være smart hvis de kunne gemmes et sted f.eks og genbruges ... ellers så behold som nu hvor det hele er i config filen


// callback stuff how ? - could just be added in the validate method ?

// function til at bestemme om et bestemt field er valid ... så hvis form_validaiton er kørt er det muligt at finde ud af om yderligere validering skal køres...



        // $this->isvalid = $this->form_validation->run($validationgroup) == TRUE;

        

abstract class InputModel extends CI_Model implements IValidatable
{
    function __construct($validationgroup)
    {
        // Call base constructor
        parent::__construct();

        // Set delimiters
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

        // Run Validation immediately before input is loaded - because input data can also be modified in the validation process.
        $this->form_validation->run($validationgroup);
    }
    
    public function is_valid()
    {
        // Checks globally and not locally ?
        // Could check locally, but always add to global ?


        echo $this->form_validation->has_errors();

        
        return !$this->form_validation->has_errors();       // check it works with the form_validation->RUN 
    }
}

?>
