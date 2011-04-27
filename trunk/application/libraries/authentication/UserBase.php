<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUser.php';

abstract class UserBase implements IUser
{
    private $id;
    private $email;
    private $firstname;
    private $lastnasme;
    private $isauthenticated;
    private $isadmin;

    function __construct($id, $email, $firstname, $lastname, $isauthenticated, $isadmin)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastnasme = $lastname;
        $this->isauthenticated = $isauthenticated;
        $this->isadmin = $isadmin;
    }

    public function is_authenticated()
    {
        return $this->isauthenticated;
    }

    public function is_admin()
    {
        return $this->isadmin;
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
        return $this->lastname;
    }

    public function get_fullname()
    {
        return $this->firstname . ' ' . $this->lastnasme;
    }
}

?>