<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserModel.php';

class UserModel extends CI_Model implements IUserModel
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

    public function insert(IUserSignUp $signup)
    {
        // Change name of function to signup / create / register ?

        // parameter name $user / $userSignUp ? 

        // Use class / iUserSignUp to insert into the database ?
        // Create db (insert/create/register/signup) model ? and do the mapping here ? - entities


        // lav seperat tabel for validation code der inkluderer id og activation/validtion-code ?



        $user = array(
            'email' => $signup->get_email(),
            'passwordhash' => $signup->get_passwordhash(),
            'passwordsalt' => $signup->get_passwordsalt(),
            'firstname' => $signup->get_firstname(),
            'lastname' => $signup->get_lastname(),
            'activationcode' => $signup->get_activationcode());
        
        // Insert into db
        $this->db->insert('user', $user);

        // Get the inserted id
        $userid = $this->db->insert_id();

        // Update the user
        $signup->set_id($userid);
    }

    public function validate($code)
    {
        // Should include the user id for proper security
        // Also it allows to validate more than one time because where isactivated == FALSE is not included

        // take the user/email validation model - containing $code and id/email
        // put validation code into seperate tabel delete when validated ? but then i cant tell that it the user is already validated if tried twice ?

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




    public function is_unique_email($email)
    {
        $query = $this->db->get_where('user', array('email' => $email), 1);
        return $query->num_rows() == 0;
    }
}