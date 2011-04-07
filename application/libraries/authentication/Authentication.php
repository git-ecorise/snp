<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iIdentity.php';
require_once 'iAuthentication.php';
require_once 'DefaultUser.php';
require_once 'AuthenticatedUser.php';

 // This is the worst crap ever - how do i avoid those require_once statements ?



// Authentication - SERVICE ? + interface og smid under services folder ?

// Identification ?

class Authentication implements iAuthentication
{
    protected $key = 'user';
    protected $CI;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();
    }

    public function login(iIdentity $identity)
    {
        // Add user to session
        $this->CI->session->set_userdata($this->key, $identity);
    }

    public function logout()
    {
        // Remove user from session
        $this->CI->session->unset_userdata('user');
    }

    public function get_user()
    {
        // Get user from session
        $user = $this->CI->session->userdata('user');

        // If user is not found return DefaultUser
        if (!$user)
            return new DefaultUser();

        return $user;
    }
}

?>
