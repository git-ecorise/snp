<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUser.php';

class AuthenticatedUser implements IUser
{
    private $id;
    private $email;
    private $firstname;
    private $lastnasme;

    function __construct($id, $email, $firstname, $lastname)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastnasme = $lastname;
    }

    public function is_authenticated()
    {
        return true;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_firstname()
    {
        return $this->firstname;
    }

    public function get_lastname()
    {
        return $this->lastname();
    }

    public function get_fullname()
    {
        return $this->firstname . ' ' . $this->lastnasme;
    }
}

?>