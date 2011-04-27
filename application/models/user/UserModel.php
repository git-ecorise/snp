<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUserModel.php';

// Update interface ? or just remove it? doesnt make any sense , we are not going to inject it anyway ?
// could create UserService which requires a IUserModel injected - then UserService is just a wrapper around UserModel ?

// Rename to UserDB or UserRepository ... or UserService and put in Libraries ?

class UserModel extends CI_Model implements IUserModel
{
    function __construct()
    {
        parent::__construct();
    }

    public function create(ISignUpInput $input)
    {
        // create / insert / signup ?
        // Use entity class instead ?

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

        // Date Created ?

        // Insert into db
        $this->db->insert('user', $user);

        // Get the inserted id
        //$userid = $this->db->insert_id();

        // Update the user
        //$input->set_id($userid);
    }

    public function validate(IValidationInput $input)
    {
        // put validation code into seperate tabel delete when validated ?
        // datevalidated / validateddate ? 
               
        $this->db->where('isvalidated', FALSE);
        $this->db->where('email', $input->get_email());
        $this->db->where('validationcode', $input->get_validationcode());
        
        $this->db->update('user', array('isvalidated' => TRUE));    // + DateValidated ?

        return $this->db->affected_rows() > 0;
    }






    

    public function get_by_email($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));

        return $query->row();
    }






    // Rename to search_by_name ? eller bare search ? - skal også være en search_by_interests
    public function get_all_by_name($fullname)
    {
        // Improve this - look at active record - like
        // Always look up from the start of the word ? or match anywhere in the name?

        // Split all by space
        $names = explode(' ', $fullname);

        // Create search query that searches for each "word" / name
        foreach ($names as $name)
        {
            $this->db->like('LOWER(firstname)', strtolower($name));
            $this->db->or_like('LOWER(lastname)', strtolower($name));
        }

        $this->db->where('isvalidated', TRUE);
        $query = $this->db->get('user');

        return $query->result();
    }




    // Used in callbacks for validation
    
    // Move somewhere else ? on input models ? which then calls here ? or create UserService which have all the callbacks ? or should it be in the controller ?
    // Lav standard metoder her og så flyt callbacks ud ? email_validated / is_email_valdiated ?

    // Behøver ihvertfald ikke at være en del af et interface da der kaldes direkte
    // Kunne også bare lave en model kun til callbacks ...

    

    // Validate email
    public function email_exist($email)
    {
        $this->db->select('1', FALSE)->from('user')->where('email', $email)->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function email_validated($email)
    {
        // is_email_validated ?

        $this->db->select('1', FALSE)->from('user')->where('email', $email)->where('isvalidated', TRUE)->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

    public function email_not_validated($email)
    {
        return !$this->email_validated($email);

        /*
        $this->db->select('1', FALSE)->from('user')->where('email', $email)->where('isvalidated', FALSE)->limit(1);
        $query = $this->db->get();

        return $query->num_rows() > 0;
        */
    }
    
    // Sign up
    public function is_unique_email($email)
    {
        return !($this->email_exist($email));
    }

    //updates user
    public function update($email, $user)
    {
        $this->db->where('email', $email);
        $this->db->update('user', $user);
    }
}