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

        $this->from = $config['from'];
        $this->name = $config['name'];
    }

    public function send_validation_email($email, $code)
    {
        $this->CI->load->library('email');

        $this->CI->email->from($this->from, $this->name);
        $this->CI->email->to($email);

        $this->CI->email->subject('Validate your email');
        $this->CI->email->message('<a href="' + validate_route($code) + '">Click here to validate</a>');
        $this->CI->email->set_alt_message('Your validation code is: ' . $code);

        // Disabled for presentation

        // Send the email
        /*
        if (!$this->CI->email->send())
            show_error($this->CI->email->print_debugger());
        else
            echo 'Email sent - here is the validation code:' . $code;
        */
    }
}
?>