<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iEmailService.php';

class EmailService implements iEmailService
{
    protected $CI;
    protected $from;
    protected $name;
    
    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load Config
        $this->from = $config['from'];
        $this->name = $config['name'];
    }

    public function send_validation_email($email, $code)
    {
        $this->CI->load->library('email');

        // Setup
        $this->CI->email->from($this->from, $this->name);
        $this->CI->email->to($email);

        $this->CI->email->subject('Validate your email - ' . $this->name);
        $this->CI->email->message('Please validate your email.<br /><a href="' + validate_route($code) + '">Click here to validate</a>');
        $this->CI->email->set_alt_message('Your validation code is: ' . $code);

        // Send the email
        $success = !$this->CI->email->send();

        // Only in development !
        /*
        if (!$success)
            show_error($this->CI->email->print_debugger());
        */
    }
}
?>