<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserModel.php';

class UserModel extends CI_Model implements IUserModel
{
    function __construct()
    {
        parent::__construct();
    }

    public function create(ISignUpInput $input)
    {
        // Prepare data
        $this->load->helper('crypto');
        $passwordsalt = generate_salt();
        $passwordhash = generate_hash($input->get_password(), $passwordsalt);

        $user = array(
            'email' => $input->get_email(),
            'passwordhash' => $passwordhash,
            'passwordsalt' => $passwordsalt,
            'firstname' => $input->get_firstname(),
            'lastname' => $input->get_lastname(),
            'validationcode' => $input->get_validationcode(),
            'isvalidated' => FALSE);

        // Insert into db
        $this->db->insert('users', $user);
    }

    public function validate(IValidationInput $input)
    {
        $this->db->where('isvalidated', FALSE);
        $this->db->where('email', $input->get_email());
        $this->db->where('validationcode', $input->get_validationcode());
        
        $this->db->update('users', array('isvalidated' => TRUE));

        return $this->db->affected_rows() > 0;
    }

    public function reset_password(IResetPasswordInput $input)
    {
        $this->db->where('email', $input->get_email());
        $this->db->update('users', array('passwordresetcode' => $input->get_resetcode()));

        return $this->db->affected_rows() > 0;
    }

    public function change_password(IChangePasswordInput $input)
    {
        // Prepare data
        $this->load->helper('crypto');
        $passwordsalt = generate_salt();
        $passwordhash = generate_hash($input->get_password(), $passwordsalt);

        $this->db->where('email', $input->get_email());
        $this->db->where('passwordresetcode', $input->get_resetcode());

        $this->db->update("users", array("passwordresetcode" => NULL, "passwordhash" => $passwordhash, "passwordsalt" => $passwordsalt));

        return $this->db->affected_rows() > 0;
    }

    public function get_by_email($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));

        return $query->row();
    }

    public function get_all_by_name($fullname)
    {       
        // Split all by space
        $names = explode(' ', $fullname);
        
        // Create search query that searches for each "word" / name
        foreach ($names as $name)
        {
            $this->db->like('LOWER(firstname)', strtolower($name));
            $this->db->or_like('LOWER(lastname)', strtolower($name));
        }

        // Should be validated
        $this->db->where('isvalidated', TRUE);
        // Should not be yourself (logged in user)
        $this->db->where('id !=', get_user()->get_id());

        $query = $this->db->get('users');

        return $query->result();
    }

    public function update($id, $user)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $user);
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('users', array('id' => $id), 1);
        return $query->row();
    }

    // Used in callbacks for validation
    
    // Validate email
    public function email_exist($email)
    {
        $this->db->select('1', FALSE)->from('users')->where('email', $email)->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function email_validated($email)
    {
        $this->db->select('1', FALSE)->from('users')->where('email', $email)->where('isvalidated', TRUE)->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function email_not_validated($email)
    {
        return !$this->email_validated($email);
    }
    
    // Sign up
    public function is_unique_email($email)
    {
        return !($this->email_exist($email));
    }
}