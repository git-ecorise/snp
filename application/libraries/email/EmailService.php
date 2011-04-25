<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IEmailService.php';

class EmailService implements IEmailService
{
    protected $CI;
    protected $from;
    protected $name;
    
    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load the email library
        $this->CI->load->library('email');

        // Load Config
        $this->from = $config['from'];
        $this->name = $config['name'];

        // Setup defaults
        $this->CI->email->from($this->from, $this->name);     
    }
    
    public function send_signup_email(IUserSignUp $user)
    {
        // Create email
        $this->CI->email->to($user->get_email());


        


        // Include the id somehow, because it is needed when validating the email ?
        // Split validationcode out into seperate table and delete when no longer needed ?

        // but if id isnt found it will require you to enter both the validation code and your email to validate it - so it can look up the id ?

        // Why not always use the email then ? its less predictable to ...

        $this->CI->email->subject('Validate your email - ' . $this->name);
        $this->CI->email->message('Please validate your email.<br /><a href="' + validate_route($user->get_activationcode()) + '">Click here to validate</a>');
        $this->CI->email->set_alt_message('Your validation code is: ' . $user->get_activationcode());


        
        // Send the email
        $success = $this->CI->email->send();


        
        // Only in development !
        if (!$success)
            show_error($this->CI->email->print_debugger());
    }
}
?>