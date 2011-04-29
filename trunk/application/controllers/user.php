<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function signup()
    {
        // If already authenticated redirect
        redirect_if_authenticated('You have already signed up.');
        
        if ($_POST)
        {
            // Post request

            $this->load->model('user/SignUpInput');
          
             // Check if input is valid
            if ($this->SignUpInput->is_valid())
            {
                // Success

                // Insert into database
                $this->load->model('user/UserModel');
                $this->UserModel->create($this->SignUpInput);

                // Send signup email
                $this->load->library('email/EmailService');
                $this->emailservice->send_signup_email($this->SignUpInput->get_email(), $this->SignUpInput->get_validationcode());

                // Set status message
                set_status_message('You have signed up!');

                // Redirct
                return redirect(signup_success_route());            // Login ?
            }
        }

        // Default fallback
        
        $this->template->load('user/signup');
    }

    public function signupsuccess()
    {
        // Could make check that only people comming straight from signup is allowed to view this
        // use flashdata in signup - and check if it exists here.
        // Use flashdata_keep to be able to refresh the page without getting an error
        
        $this->template->load('user/signup_success');
    }
    
    public function login()
    {
        // If already authenticated redirect
        redirect_if_authenticated('You are already logged in.');

        $viewdata = array();
            
        if ($_POST)
        {
            // Post request
            
            $this->load->model('user/LoginInput');

            if ($this->LoginInput->is_valid())
            {
                // Success

                // Try to get the user by email
                $this->load->model('user/UserModel');
                $user = $this->UserModel->get_by_email($this->LoginInput->get_email());

                // Check if user was found                                                          // NOT REALLY NEEDED !?!??!?!?!
                if ($user != NULL)
                {
                    // Verify credentials
                    $this->load->helper('crypto');
                    $isvalidcredentials = verify_hash($user->passwordhash, $this->LoginInput->get_password(), $user->passwordsalt);

                    if ($isvalidcredentials)
                    {
                        // Success

                        // Login
                        $authUser = new AuthenticatedUser($user->id, $user->email, $user->firstname, $user->lastname, $user->isadmin, $user->hasimage);
                        $this->authenticationservice->login($authUser);

                        // Set status message
                        set_status_message('You have been logged in!');

                        // Redirct - returns immediatly
                        return redirect(profile_route());
                    }
                }

                // Set status message
                set_status_message('Login was incorrect. Please try again.', $viewdata);             
            }
        }

        // Default fallback

        $this->template->load('user/login', $viewdata);
    }
  
    public function logout()
    {
        // Logout
        $this->authenticationservice->logout();
        // Set status message
        set_status_message('You have been logged out!');
        // Redirect
        redirect(home_route());
    }
   
    public function validate($email = '', $code = '')
    {
        // If get request with email/code parameters treat it like a post
        // This will be the case when people click the link in the email
        if ($email != '')
            $_POST['email'] = urldecode($email);
        if ($code != '')
            $_POST['validationcode'] = $code;

        // Check if there is any post data
        if ($_POST)
        {
            // Post data is found

            $this->load->model("user/ValidationInput");

            // Check if input is valid
            if ($this->ValidationInput->is_valid())
            {
                // Try to validate
                $this->load->model('user/UserModel');
                $success = $this->UserModel->validate($this->ValidationInput);

                if ($success)
                {
                    // Set status message
                    set_status_message('Your email have been validated');

                    // Could login directly here - but could be a security problem, if some hacker have got hold of the email (he still dont know the password)
                    
                    // Redirct
                    return redirect(login_route());
                }
                
                $this->form_validation->add_error('validationcode', 'The validation code is invalid.');                     // move to usermodel / repository / service - wrapper omkring ?
            }
        }
        
        // Default fallback
        
        $this->template->load('user/validate');
    }
    
    public function resetpassword()
    {
        // Check if there is any post data
        if ($_POST)
        {
            // Post data is found

            $this->load->model("user/ResetPasswordInput");

            // Check if input is valid
            if ($this->ResetPasswordInput->is_valid())
            {
                // Success

                // Insert reset code into database
                $this->load->model('user/UserModel');
                $this->UserModel->reset_password($this->ResetPasswordInput);

                // Send reset password email
                $this->load->library('email/EmailService');
                $this->emailservice->send_reset_password_email($this->ResetPasswordInput->get_email(), $this->ResetPasswordInput->get_resetcode());


                // Redirct
                return redirect(reset_password_success_route());        // Jump directly to change password page and just show status message ?
            }
        }
   
        // Default fallback

        $this->template->load('user/resetpassword');
    }

    public function resetpasswordadmin($id)
    {
        // Check user is admin
        if (!is_admin() || is_nan($id))
            return redirect (profile_route());

        // Look up email
        $this->load->model('user/UserModel');
        $user = $this->UserModel->get_by_id($id);

        if ($user != null)
        {
            // User found
            
            // Put into Post to load ResetPasswordInput
            if ($email != '')
                $_POST['email'] = $user->email;

            $this->load->model("user/ResetPasswordInput");

            if ($this->ResetPasswordInput->is_valid())
            {
                // Insert reset code into database
                $this->UserModel->reset_password($this->ResetPasswordInput);

                // Send reset password email
                $this->load->library('email/EmailService');
                $this->emailservice->send_reset_password_email($this->ResetPasswordInput->get_email(), $this->ResetPasswordInput->get_resetcode());
            }
        }

        // Always redirect back to the profile page
        if ($id == get_user()->get_id())
            return redirect (profile_route());

        return redirect(friend_profile_route($id));
    }

    public function resetpasswordsuccess()
    {
        $this->template->load('user/resetpassword_success');
    }

    public function changepassword($email = '', $code = '')
    {
        // If get request with email/code parameters treat it like a post
        // This will be the case when people click the link in the email
        if ($email != '')
            $_POST['email'] = urldecode($email);
        if ($code != '')
            $_POST['resetcode'] = $code;

        // If there is any post data and it is a post request
        if ($_POST)
        {
            // Post data is found

            $this->load->model("user/ChangePasswordInput");

            // Check if input is valid
            if ($this->ChangePasswordInput->is_valid())
            {
                // Try to validate
                $this->load->model('user/UserModel');
                $success = $this->UserModel->change_password($this->ChangePasswordInput);

                if ($success)
                {
                    // Set status message
                    set_status_message('Your password have been changed. Please login');        // Succes Page? hvad hvis man allerede er logged in ?

                    // Redirct
                    return redirect(login_route());
                }

                $this->form_validation->add_error('resetcode', 'The reset code is invalid.');
            }
        }

        // Default fallback

        $this->template->load('user/changepassword');
    }








    // Søg efter interesse og søg efter navn - resultat skal være det samme - lav partial til at vise søge resultat

    // Should not be part of the User Controller - move somewhere else ... Profile ?
    
    public function search($name = '')
    {
        // Ensure user is authorized to view the page
        ensure_authenticated();

        $viewdata = array();

        if ($_POST)
        {
            $this->load->model("user/SearchInput");

            // Validate form input
            if ($this->SearchInput->is_valid())
            {
                // Success

                // Search the database
                $this->load->model('user/UserModel');
                $result = $this->UserModel->get_all_by_name($this->SearchInput->get_name());     // Pass input model instead and use interface then it could be extended in the future

                // If any results found add to the viewdata
                if ($result != null)
                {
                    $viewdata['result'] = $result;
                }
            }
        }

        $this->template->load('user/search', $viewdata);
    }
}