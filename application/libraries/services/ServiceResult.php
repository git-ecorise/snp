<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iServiceResult.php';
require_once 'iValidationResult.php';

// intern variable that determines if success ? or let validation result determine it ?
// should validation result be changed to result or errorResult ?

class ServiceResult implements iServiceResult
{
    var $data;
    var $validationresult;

    function __construct($data, iValidationResult $validationresult)
    {
        $this->data = $data;
        $this->validationresult = $validationresult; 
    }

    public function get_data()
    {
        return $this->data;
    }

    public function get_validationresult()
    {
        return $this->validationresult;
    }

    public function is_success()
    {
        return $this->validationresult->is_valid(); // intern variable issuccess ?
    }
}

?>
