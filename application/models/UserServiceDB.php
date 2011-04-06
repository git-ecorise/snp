<?php

/**
 * Description of Login_db
 *
 * @author BigSlott
 */
class UserServiceDB extends CI_Model{
    
    public function  __construct() {
        parent::__construct();
    }

    public function check_user_email($user_email)
    {
        //check in db if user_password exist
        $this->db->where('email', $user_email);
        $query = $this->db->get_where('users');

        return $query->num_rows() > 0 ? TRUE : FALSE;
    }

    public function create_user($user)
    {
        $this->db->insert('users', $user);
    }

    public function user_login($user_email)
    {
        //Check against user table
        $this->db->where('email', $user_email);
        $query = $this->db->get_where('users');

        return $query->num_rows() > 0 ? $query->row_array() : NULL;
    }

    public function get_user($user_email)
    {
        $this->db->where('email', $user_email);
        return $this->db->get_where('users')->row_array();
    }

    public function delete_user($user_id)
    {
        $this->db->delete('users', array('id' => $user_id));
    }

    public function activate_user($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', array('isactivated'=>TRUE));
    }
}
?>
