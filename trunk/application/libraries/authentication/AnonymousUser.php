<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'UserBase.php';

class AnonymousUser extends UserBase
{
    function __construct()
    {
        parent::__construct();
    }
}

?>
