<?php

/**
 * Description of UserService
 *
 * @author BigSlott
 */
class UserService {
    var $CI;
    
    function create($user_email = '', $user_password = '', $first_name = '', $last_name = '')
    {
        $this->CI =& get_instance();
        
        //Make sure account info was sent
        if($user_email == '' OR $user_password == '' OR $first_name == '' OR $last_name == '')
        {
            return false;
        }

        //Check if user_email already exist in db
        if ($this->CI->UserServiceDB->check_user_email($user_email)) //user_email already exists
            return false;

        //hash the user_password with sha1(php build in function)
        //TODO hash it in another way
        $hashed_passsword = sha1($user_password);

        //genereate activation code
        //TODO: create the mechanism that does this
        $activation_code = "activate";

        //create user object
        $user = array(
            'email' => $user_email,
            'password' => $hashed_passsword,
            'firstname' => $first_name,
            'lastname' => $last_name,
            'activation_code' => $activation_code,
            'isactivated' => false
        );

        //insert data into database
        $this->CI->UserServiceDB->create_user($user);

        //send email_confirmation
        $this->send_email_confirmation($user_email);

        //TODO: if autologin then login the user automatically in

        //return true if we got this far because then the user is created!
        return TRUE;
    }

    public function confirm_create()
    {
        //TODO: confirm the user and set the isActivated in db to true
    }

    private function send_email_confirmation($email)
    {
        
        //TODO: send the email to the user
        $this->CI->load->library('email');

        $this->CI->email->from('your@example.com', 'Your Name');
        $this->CI->email->to($email);

        $this->CI->email->subject('Email Test');
        $this->CI->email->message('Testing the email class.');

        $this->CI->email->send();

        echo $this->CI->email->print_debugger();
    }

    function login($user_email = '', $user_password = '')
    {
        $this->CI =& get_instance();

        //Make sure account info was sent
        if($user_email == '' OR $user_password == '')
            return false;

        //Check if already logged in
        if($this->CI->session->userdata('user_email') == $user_email)
            return true;

        //check email and password against user table
        $user_data = $this->CI->UserServiceDB->user_login($user_email);
        if(!$user_data==NULL)
        {
            //Destroy old session
            $this->CI->session->sess_destroy();

            //check against hashed password
            $hashed_password = sha1($user_password);
            if(!$hashed_password == $user_data['password'])
                return false;

            //Create a fresh, brand new session
            $this->CI->session->sess_create();

            //Set session data
            unset($user_data['password']);
            $user_data['logged_in'] = true;
            $this->CI->session->set_userdata($user_data);
            print_r($user_data);
            print "<br/>succes";
            return TRUE;
        }
        else
        {
            print "fail";
            return FALSE;
        }
        
    }

    function logout()
    {
        $this->CI =& get_instance();

        //destroy the session
        $this->CI->session->sess_destroy();
    }

    function delete($user_id)
    {
        $this->CI =& get_instance();
        
        //check if it is numeric
        if(!is_numeric($user_id))
            return false;

        $this->CI->UserServiceDB->delete_user($user_id);
    }

    function activate($user_email, $activation_code)
    {
        $this->CI =& get_instance();

        //get the user
        $user = $this->CI->UserServiceDB->get_user($user_email);

        //check if activation code is validate
        if(!$activation_code == $user['activation_code'])
            return FALSE;
        
        //activate user
        $this->CI->UserServiceDB->activate_user($user['id']);

        return TRUE;
    }
}
?>
