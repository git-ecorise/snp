<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iServiceResult
{
    public function is_success();
    public function get_data();
    public function get_validationresult();
}

?>
