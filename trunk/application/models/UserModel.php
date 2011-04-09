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
        // implement returning the created user id for validation (insert_id)
        $this->db->insert('user', $user);
    }

    public function validate($code)
    {
        // Should include the user id for proper security
        // Also it allows to validate more than one time because where isactivated == FALSE is not included
        $this->db->where('activationcode', $code);
        $this->db->update('user', array('isactivated' => TRUE));

        return $this->db->affected_rows() > 0;
    }
  
    public function get_all_by_name($name)
    {
        // Very quick search implementation - surely have to be improved someday ...
        // Etc split $name by ' ' and use every word instead
        $this->db->like('LOWER(firstname)', strtolower($name));
        $this->db->or_like('LOWER(lastname)', strtolower($name));
        $this->db->where('isactivated', TRUE);
        $query = $this->db->get('user');

        return $query->result();
    }
}