<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iValidatable
{
    // Return iValidationResult
    public function validate();
}

?>
