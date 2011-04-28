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
                        return redirect(usersearch_route());                                // Should go to the wall /profile/
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
            $_POST['validationcode'] = $code;                               // also encode/decode this ?

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




    // TEST AT RESET CODE OG CHANGE PASSWORD VIRKER EFTER HENSIGTEN ... FÆRDIG
    // REFACTOR ...

    // FIX SØG ...

    // IS ADMIN DEL TIL LAYOUT - SÅ ADMIN KAN RESETTE PASSWORD (Skal bare kalde resetpassword metoden med brugerens email)
    // Samt sende over til Update profile hvor der skal tests på om man er authenticated bruger som profilen tilhører eller admin ....

    // Det er vigtigt at der er sikkerheds tjek på om det id man prøver at opdaterer hænger sammen med det ID man er signed ind som ... LAV HELPER



    


// Refactor authentication_helper
// ResetPassword
// Image / Upload Service + config
// Fix DB
// FIX SØG - pænere opstilling med billede navn , og interests etc ... kan også bruges til søg efter interesse ????

// Admin del til profile / wall
// Set title i alle views...
    


//***** IMPORTANT

// Lad IUserValidationInput arve fra IValidatable ?

// Så kan form_validation og resten drønes i model reelt ?

// Metoder Create / Validate i UserModel skal så bare starte med at tjekke - if input->is_valid() - hvis ikke return false - hvis true forsæt ... lav så tjek og hvis problemer set fejl ...

// Virker det også for Signup ? Hvad med login


    
// DB structure - columns og size/length
// passwordhash = 50 chars
// passwordsalt = 40 chars

// Put Input as suffix to all input models
// All db models is renamed to UserDb ? or UserRepository, or UserService (in libraries)





    
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

                // Set status message
                //set_status_message('You have been sent an email with the reset code.');

                // Redirct
                return redirect(reset_password_success_route());        // Jump directly to change password page and just show status message ?
            }
        }
   
        // Default fallback

        $this->template->load('user/resetpassword');
    }

    public function changepassword($email = '', $code = '')
    {
        // If get request with email/code parameters treat it like a post
        // This will be the case when people click the link in the email
        if ($email != '')
            $_POST['email'] = urldecode($email);
        if ($code != '')
            $_POST['resetcode'] = $code;                                                // also encode/decode this ?

        // Check if there is any post data
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
                    set_status_message('Your password have been changed. Please login');            // INGEN SUCCESS PAGE !?

                    // Redirct
                    return redirect(login_route());
                }

                $this->form_validation->add_error('resetcode', 'The reset code is invalid.');
            }
        }

        // Default fallback

        $this->template->load('user/changepassword');
    }







    // Should not be part of the User Controller - move somewhere else ... Profile ?
    
    public function search($name = '')
    {
        // Ensure user is authorized to view the page
        ensure_authorized();                            // ensure_authenticated ?

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