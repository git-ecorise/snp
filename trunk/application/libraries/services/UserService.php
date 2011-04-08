<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserService.php';
require_once 'ServiceResult.php';

class UserService implements iUserService
{
    protected $CI;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Any configuration ?
    }

    public function create(iUserCreate $create)
    {
    }



    function authenticate(iUserLogin $login)
    {
        // return Authenticated eller DefaultUser() via data ? gør det hele lidt letterer


        // Kald login direkte herfra eller istedet returner ServiceResult der har data felt så det kan gøres i controller


        // Resposible for check if data is valid ?
        // Or always assume they are okay and just call the database and make the checks and return true false ?

        // How do i move error messages to the view ?
        // Return validation object - isValid - errors ?


        
        // Validate and get ValidationResult
        $result = $login->validate();
        
        if ($result->is_valid())
        {


            // Get from database and validate email/password

            // if valid email/password return result? (must be valid since it is here) ?
            // or create new result? and return ? or just return / true false from here ?

            // remember to Login user if valid email/password
            // should the logic be here ? mixed with teh database ? or call Authentication Service?

            // Or just move the database stuff to the User_model (DB) and call user.get_logindata(); ? should that return dbQueryResult ? or just operate with the result/array returned from build in ?



            //$result = user_model.get_logindata($model->get_email(), $model->get_password());
        }
        else
        {
            // wrap i result istedet - iServiceResult? - is_success ?
            return $model;
        }


        // Update login with id? and let userController call authentication->login() ?
        // or just call from here instead and return ?

        

        return new ServiceResult($login, $result);





                    // Service
/*
            $this->db->select('id, passwordhash, passwordsalt');    // isvalidated and more ?
            $this->db->where('email', $email);                      // escape?
            $this->db->where('isvalidated', TRUE);
            $this->db->limit(1);

            $query = $this->db->get('users');   // user

            // is there any way you can send object to get/query method which it can automatically fill ?

            if ($query->num_rows() > 0)
            {
                $record = $query->row_array();

                // Create user object used for when authenticated / signed in
                // Or get data to array ($record) ?

                $id = $record['id'];
                $passwordhash = $record['passwordhash'];
                $passwordsalt = $record['passwordsalt'];

                // Authenticate user and call Authentication/Identification service (or just it self) Login(User)
                // Return true or array with data
            }
            else
            {
                // Create an error message or something that says Email or Password is incorrect
                // return view
            }
 */






    }

    /*
    public function validate(UserActivate $activation)
    {
        // UserActivate ?
    }
    */
}

?>
