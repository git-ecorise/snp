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

    protected function send_email($email, $subject, $html, $text)
    {
        // prepare data
        $subject = $subject . ' - The Social Network';

        $this->CI->email->to($email);

        $this->CI->email->subject($subject);
        $this->CI->email->message($html);
        $this->CI->email->set_alt_message($text);

        return $this->CI->email->send();
    }
    
    public function send_signup_email($email, $code)
    {
        $subject = 'Validate your email';
        $html = 'Thanks for signing up.<br />Your validation code is: ' . $code . '<br /><br /><a href="' . validate_route($email, $code) . '">Click here</a> to automatically validate your email.';
        $text = 'Thanks for signing up.\r\nYour validation code is:' . $code;

        // Send the email
        $this->send_email($email, $subject, $html, $text);
    }

    public function send_reset_password_email($email, $code)
    {
        $subject = 'Reset Password';
        $html = 'You have requested to reset your password.<br />Your reset code is: ' . $code . '<br /><br /><a href="' . resetpassword_route($email, $code) . '">Click here</a> to automatically reset your password.';
        $text = 'You have requested to reset your password.\r\nYour reset code is:' . $code;

        // Send the email
        $this->send_email($email, $subject, $html, $text);
    }
}
?>