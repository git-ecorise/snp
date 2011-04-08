<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserModel.php';

// Remember could pass a class to be instantiated

// Use chaining
//$this->db->select('*')->from('user')->where('email', $email)->limit(10, 20);
//$query = $this->db->get();

class UserModel extends CI_Model implements iUserModel
{
    function __construct()
    {
        parent::__construct();

        // Load database here if not autoloaded
    }

    public function get_by_email($email)
    {
        $query = $this->db->get_where('user', array('email' => $email), 1);
        return $query->row();
    }

    public function create($user)
    {
        // Get values and escape
        // array or variables


        
        $this->db->insert('user', $user);
        //$this->db->insert_id()
    }
}




    //function role_exists($key) {
    //$this->db->where('rolekey',$key);
    //  $query = $this->db->get('roles');
    //     if ($query->num_rows() > 0){
    //          return true;     }
    //          else{         return false;     } }