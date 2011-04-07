<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserService.php';


// prøv at logge ind og se hvad data der bliver sat og det virker?

class UserService implements iUserService
{
    protected $CI;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Any configuration ?

        // Init db ?
    }

    public function create(UserCreate $create)
    {
    }

    public function authenticate(UserLogin $login)
    {
        // Kald login herfra ? ellers skal data med frem og tilbage ?
        // iServiceResult kan indeholde is_success + data / model felt ? + iValidationResult
    }

    public function validate(UserActivate $activation)
    {
        // UserActivate ?
    }
}

?>
