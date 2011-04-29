<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'UserBase.php';

class AuthenticatedUser Extends UserBase
{
    function __construct($id, $email, $firstname, $lastname, $isadmin = FALSE, $hasimage = FALSE)
    {
        parent::__construct($id, $email, $firstname, $lastname, TRUE, $isadmin, $hasimage);
    }

    public function set_has_image($hasimage)
    {
        $this->hasimage = $hasimage;
    }
}

?>