<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iUserModel.php';

class UserModel extends CI_Model implements iUserModel
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_by_email($email)
    {
        $query = $this->db->get_where('user', array('email' => $email), 1);
        return $query->row();
    }

    public function insert($user)
    {
        // return id later for validation
        $this->db->insert('user', $user);
    }

    public function validate($code)
    {
        // danger ... just quick impl - should be removed and use both id and code
        $this->db->where('activationcode', $code);
        $this->db->update('user', array('isactivated' => TRUE));
        return $this->db->affected_rows() > 0;
    }
  
    public function get_all_by_name($name)
    {
        $this->db->like('LOWER(firstname)', strtolower($name));
        $this->db->or_like('LOWER(lastname)', strtolower($name));
        
        $this->db->where('isactivated', TRUE);
        $query = $this->db->get('user');

        return $query->result();
    }
}