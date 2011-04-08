<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface iEmailService
{
    public function send_validation_email($email, $code);
}

?>
