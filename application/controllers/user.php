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

            $this->load->model('input/UserSignUp');

             // Check if input is valid
            if ($this->UserSignUp->is_valid())
            {
                // Success

                // Insert into database
                $this->load->model('db/UserModel');
                $this->UserModel->insert($this->UserSignUp);

                // Send signup email
                $this->load->library('email/EmailService');
                $this->emailservice->send_signup_email($this->UserSignUp);

                // Set status message
                set_status_message('You have signed up!');



                // For presentation only - delete and change view (signup_success) ******
                $this->session->set_flashdata('code', $activationcode);



                // Redirct
                return redirect(signup_success_route());
            }
        }

        // Default fallback
        
        $this->template->load('user/signup');
    }

    public function signupsuccess()
    {
        // Could make check that only people comming straight from signup is allowed to view this
        // use flashdata in signup - and check if it exists here.
        
        $this->template->load('user/signup_success');
    }



    // resetpassword - email
    // create reset code and send email
    // When link clicked go to page where code, new password + password confirm can be entered.
    // 
    // if reset attempted check if the code exists if yes - set new password... and login ? 








    // Put this in a helper ? or does it have to be on the controller ?

    // is_email_unique ? - create function in model ...

    

    // Simple callback validator for the email
    public function is_email_available($email)
    {
        // Move the logic to function somewhere ...
        // Put callback somewhere else ? base controller - core ?


        
        // Set callback error message (could be set elsewhere - in cofig file)
        $this->form_validation->set_message('is_email_available', 'The %s is already signed up.');

        // Check if email exists - Could use more optimal query
        $this->load->model('db/UserModel');
        return $this->UserModel->get_by_email($email) == null;
    }





    
    public function login()
    {
        // If already authenticated redirect
        redirect_if_authenticated('You are already logged in.');

        $viewdata = array();
            
        if ($_POST)
        {
            // Post request
            
            $this->load->model('input/UserLogin');

            if ($this->UserLogin->Validate())
            {
                // Success


                // UserLogin->verify_credentials() ....
                // Hvordan tjekker jeg om isactivated ? skal den så hente dataene ind på UserLogin modellen så de er tilgængelige der ? eller hvordan ?

                // Fix også lige db når du nu er igang ... length på columns og navne ... samt opret nye tabeller ...

                // Lav helper metode til signin istedet for at kode direkte her ... så kald og send iUserLogin med eller noget ... data objekt der indeholder nødvendige data for at sign in !?
                // Skal også bruge userid - brug iUserLogin eller lav seperat objekt / interface til den del !? - interface ihvertfald iUser skal den have ind ? men hvor skal mapping ske?
                // Ville være smart hvis en / et eller andet kunne spytte en iUser tilbage som har alt der skal bruges



                // Fremgår det tydeligt nok at Validate validerer input !? is_valid_input eller validate_input istedet?

                


                // Try to get the user by email
                $this->load->model('db/UserModel');
                $user = $this->UserModel->get_by_email($this->UserLogin->get_email());



                
                // Need to seperate some stuff here... someday
                // Put Logic for validating the email somewhere else - right now logic for generating password is put in UserSignUp so could put check in UserLogin but it doesnt feel right
                // Maybe create a helper somewhere that can be used for both generating the password and for checking - would be the right thing to do... 



                
                // Check if user was found
                if ($user != null)
                {

                    // Replace this - should use the user->validate_credentials() ...
                    // could create interface that contains function for validate/verify/check _credentials
                    // create service that login/authenticate any object containing the verify_credentials - if it returns true do the stuff...

                    // checking if user is activated really isnt logic that should be here ...


                    // Some service that can consume the userLogin and tell it is okay ...
                    // the logic probably shouldnt be in the model ... then logic for logging in isnt keept in one place

                    // authentication should take iUser / some model / entity that contains the needed data for logging in

                    // create the db as entities and make it pssoble to return the entities in the model ?
                    

                    // Check the password - missing salt - create helper
                    $inputpasswordhash = hash('sha256', $this->UserLogin->get_password());
                    if ($inputpasswordhash === $user->passwordhash)
                    {
                        // Success

                        // Check if already activated
                        if (!$user->isactivated)        // function ? missing () ?
                        {
                            // Set status message and redirect
                            set_status_message('Please activate your Email.');
                            return redirect(validate_route());
                        }

                        // Login
                        $authUser = new AuthenticatedUser($user->id, $user->email, $user->firstname, $user->lastname);
                        $this->authentication->login($authUser);

                        // Set status message
                        set_status_message('You have been logged in!');

                        // Redirct - returns immediatly
                        return redirect(usersearch_route());
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
        $this->authentication->logout();
        // Set status message
        $this->session->set_flashdata('status', 'You have been logged out!');

        redirect(home_route());
    }
    
    public function validate($code = '')
    {
        $viewdata = array();

        // Check if it was a Post
        if ($_POST)
        {
            // Set delimiters - hide this away somehow
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            // Validate form input
            if ($this->form_validation->run('validate'))
            {
                // If valid get the input
                $code = $this->input->post('validationcode', TRUE);
            }
        }

        if ($code != '')
        {
            // Try to validate
            $this->load->model('db/UserModel');
            $success = $this->UserModel->validate($code);

            if ($success)
            {
                // Set status message
                $this->session->set_flashdata('status', 'Your email have been validated.');

                // Could login directly here - but could posses a security problem

                // Redirct
                return redirect(login_route());
            }

            // Not valid
            $viewdata['status'] = 'The validation code is invalid.';
        }
        
        // Default fallback
        
        $this->template->load('user/validate', $viewdata);
    }
    
    public function search($name = '')
    {
        // Ensure user is authorized to view the page
        ensure_authorized();

        $viewdata = array();

        if ($_POST)
        {
            // Post

            // Set delimiters - hide this away (extend controller etc...)
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            // Validate form input
            if ($this->form_validation->run('search'))
            {
                // Success
                
                // Get search term
                $term = $this->input->post('name');

                // Search the database
                $this->load->model('db/UserModel');
                $result = $this->UserModel->get_all_by_name($term);

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