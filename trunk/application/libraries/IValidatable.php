<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Move to the view input folder ? is only for validating input models ?

interface IValidatable
{
    public function is_valid();     // validate ?
}

?>
