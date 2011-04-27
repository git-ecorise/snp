<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'UserBase.php';

class AuthenticatedUser Extends UserBase
{
    function __construct($id, $email, $firstname, $lastname, $isadmin = FALSE)
    {
        parent::__construct($id, $email, $firstname, $lastname, TRUE, $isadmin);
    }
}

?>