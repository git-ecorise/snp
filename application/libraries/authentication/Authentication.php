<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iIdentity.php';

// Authentication - SERVICE ? + interface og smid under services folder ?

class Authentication implements iAuthentication
{
    protected $key = 'user';
    protected $CI;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Config ?
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
        $user = $this->CI->session->user_data('user');  // returns false if not found

        if (!$user)
            return new DefaultUser();

        return $user;
    }
}

?>
