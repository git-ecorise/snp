<?php

class UserService_FIXED {
    var $CI;
    
    function create($user)
    {
        $this->CI =& get_instance();
        
        //Make sure account info was sent
        if($user['email'] == '' OR $user['password'] == '' OR $user['firstname'] == '' OR $user['lastname'] == '')
        {
            return false;
        }

        //Check if user_email already exist in db
        if ($this->CI->UserServiceDB->check_user_email($user['email'])) //user_email already exists
            return false;

        //hash the user_password with sha1(php build in function)
        //TODO hash it in another way
        $hashed_passsword = sha1($user['password']);

        //genereate activation code
        //TODO: create the mechanism that does this
        $activation_code = "activate";

        //create user object
        $new_user = array(
            'email' => $user['email'],
            'password' => $hashed_passsword,
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'activation_code' => $activation_code,
            'isactivated' => false
        );

        //insert data into database
        //$this->CI->UserServiceDB->create_user($new_user);

        //send email_confirmation
        print $new_user['email'];
        $this->send_email_confirmation($new_user['email']);

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
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'carlsagangroup@gmail.com',
        'smtp_pass' => 'CarlS1234',
        );
        $this->CI->load->library('email', $config);
        $this->CI->email->set_newline("\r\n");

        $this->CI->email->from('gmail.login@googlemail.com', 'Your Name');
        $this->CI->email->to($email);

        $this->CI->email->subject(' CodeIgniter Rocks Socks ');
        $this->CI->email->message('Hello World');


        if (!$this->CI->email->send())
            show_error($this->CI->email->print_debugger());
        else
        echo 'Your e-mail has been sent!';
        }

    function login($login_user)
    {
        $this->CI =& get_instance();
        
        //Make sure account info was sent
        if($login_user['email'] == '' OR $login_user['password'] == '')
            return false;

        //Check if already logged in
        if($this->is_logged_in($login_user['email']))
            return true;

        //check email and password against user table
        $user_data = $this->CI->UserServiceDB->user_login($login_user['email']);
        
        if($user_data!=NULL)
        {
            //Destroy old session
            $this->CI->session->sess_destroy();

            //check against hashed password
            $hashed_password = sha1($login_user['password']);
            if($hashed_password != $user_data['password'])
                return FALSE;

            //Create a fresh, brand new session
            $this->CI->session->sess_create();

            //Set session data
            //remove the password from user_data
            unset($user_data['password']);
            $user_data['logged_in'] = true;
            $this->CI->session->set_userdata($user_data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
        
    }

    function is_logged_in($email)
    {
        $email = $this->CI->session->userdata('email');
        $isLoggedIn = $this->CI->session->userdata('logged_in');
        //Check if already logged in
        return $email == $email && $isLoggedIn == true ? true : false;
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
