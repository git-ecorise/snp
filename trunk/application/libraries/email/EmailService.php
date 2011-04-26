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
    }
    
    public function send_signup_email(IUserSignUp $user)
    {


        $this->CI->email->to('super@lynhurtig.dk');

        $this->CI->email->subject('It is working like it should 1234');
        $this->CI->email->message('It is working like it is supposed to. But Sometimes it stalls for some weird reason. Work Please Work.');


        $this->CI->email->send();





        // Create email
        //$this->CI->email->to($user->get_email());


        //echo $user->get_email();
        
        //$this->CI->email->subject('This is the subject');
        //$this->CI->email->message('This is the message. Does it work as supposed');


/*
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'carlsagangroup@gmail.com',
            'smtp_pass' => 'CarlS1234',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

*/









        // Include the id somehow, because it is needed when validating the email ?
        // Split validationcode out into seperate table and delete when no longer needed ?

        // but if id isnt found it will require you to enter both the validation code and your email to validate it - so it can look up the id ?

        // Why not always use the email then ? its less predictable to ...


        
        //$this->CI->email->subject('Validate your email - ' . $this->name);
        //$this->CI->email->message('Please validate your email.<br /><a href="' . validate_route($user->get_activationcode()) . '">Click here to validate</a>');
        //$this->CI->email->set_alt_message('Your validation code is: ' . $user->get_activationcode());









        
        
        // Send the email
        //$success = $this->CI->email->send();


        
        // Only in development !
        //if (!$success)
        //    show_error($this->CI->email->print_debugger());
    }
}
?>