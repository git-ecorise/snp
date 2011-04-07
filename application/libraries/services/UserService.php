<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserService.php';
require_once 'iUserCreate.php';
require_once 'iUserLogin.php';

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

    public function create(iUserCreate $create)
    {
    }

    function authenticate(iUserLogin $login)
    {
        // Kald login direkte herfra eller istedet returner ServiceResult der har data felt så det kan gøres i controller


        // Resposible for check if data is valid ?
        // Or always assume they are okay and just call the database and make the checks and return true false ?

        // How do i move error messages to the view ?
        // Return validation object - isValid - errors ?

        if ($login->is_valid()) // validationresult->is_valid()    is_success direkte på serviceResult
        {
            // Get from database and validate email/password

            // if valid email/password return result? (must be valid since it is here) ?
            // or create new result? and return ? or just return / true false from here ?

            // remember to Login user if valid email/password
            // should the logic be here ? mixed with teh database ? or call Authentication Service?

            // Or just move the database stuff to the User_model (DB) and call user.get_logindata(); ? should that return dbQueryResult ? or just operate with the result/array returned from build in ?

            $result = user_model.get_logindata($model->get_email(), $model->get_password());
        }
        else
        {
            // wrap i result istedet - iServiceResult? - is_success ?
            return $model;
        }
    }

    /*
    public function validate(UserActivate $activation)
    {
        // UserActivate ?
    }
    */
}

?>
