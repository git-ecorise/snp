<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUser.php';
require_once 'iAuthentication.php';
require_once 'DefaultUser.php';
require_once 'AuthenticatedUser.php';

 // This is the worst crap ever - how do i avoid those require_once statements ?



// Authentication - SERVICE ? eller Identification ?

class Authentication implements iAuthentication
{
    protected $key = 'user';
    protected $CI;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();
    }

    public function login(iUser $user)
    {
        // Add user to session
        $this->CI->session->set_userdata($this->key, $user);
    }

    public function logout()
    {
        // Remove user from session
        $this->CI->session->unset_userdata($this->key);
    }

    public function get_user()
    {
        // Get user from session
        $user = $this->CI->session->userdata($this->key);

        // If user is not found return DefaultUser
        if (!$user)
            return new DefaultUser();

        return $user;
    }
}

?>
