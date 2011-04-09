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

            // Set delimiters - hide this away (extend controller etc...)
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
            
            // Validate Form
            if ($this->form_validation->run('signup'))
            {
                // Validation is success

                // Get user input
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');

                // Prepare data
                    // Someday use salt and save it (also include in login)
                $passwordhash = hash('sha256', $password);
                $this->load->helper('string');
                $activationcode = random_string('unique');  // 32 char length

                // Load model and insert (use class instead, or send as parameters - array is ugly)
                $this->load->model('UserModel');

                $id = $this->UserModel->insert(array(
                    'email' => $email,
                    'passwordhash' => $passwordhash,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'activationcode' => $activationcode
                    ));
                
                // Send validation email
                $this->load->library('services/EmailService');
                $this->emailservice->send_validation_email($email, $activationcode);    // include the id someday for proper security

                // Set status message
                $this->session->set_flashdata('status', 'You have signed up!');

                // For presentation only - delete and change view (signup_success)
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
        $this->template->load('user/signup_success');
    }
    
    // Simple callback validator for the email
    public function is_email_available($email)
    {
        // Set callback error message (could be set elsewhere - in cofig file)
        $this->form_validation->set_message('is_email_available', '%s is already signed up');

        // Check if email exists - Could use more optimal query
        $this->load->model('UserModel');
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
                        
            // Set delimiters - hide this away (extend controller etc...)
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            // Validate Form
            if ($this->form_validation->run('login'))
            {
                // Validation is success

                // Get user input
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // Try to get the user by email
                $this->load->model('UserModel');
                $user = $this->UserModel->get_by_email($email);

                // Check if user was found
                if ($user != null)
                {
                    // Check the password - missing salt - create helper
                    $inputpasswordhash = hash('sha256', $password);
                    if ($inputpasswordhash === $user->passwordhash)
                    {
                        // Success

                        // Check if already activated
                        if (!$user->isactivated)
                        {
                             $this->session->set_flashdata('status', 'Please activate your Email.');
                             return redirect(validate_route());
                        }

                        // Login
                        $authUser = new AuthenticatedUser($user->id, $user->email, $user->firstname, $user->lastname);
                        $this->authentication->login($authUser);

                        // Set status message
                        $this->session->set_flashdata('status', 'You have been logged in!');

                        // Redirct - returns immediatly
                        return redirect(usersearch_route());
                    }
                }

                $viewdata['status'] = 'Login was incorrect. Please try again.';
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
            $this->load->model('UserModel');
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

                $this->load->model('UserModel');
                $result = $this->UserModel->get_all_by_name($term);

                // If any results add to viewdata
                if ($result != null)
                {
                    $viewdata['result'] = $result;
                }
            }
        }

        $this->template->load('user/search', $viewdata);
    }
}