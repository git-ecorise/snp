<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Remember controller actions should only dictate the flow
// Remove nesting - it is nasty... break into smaller pieces...
// Use PRG pattern

class User extends CI_Controller
{
    public function signup()
    {
        // Check if already logged in - make helper
        if (get_user()->is_authenticated())
        {
            redirect (home_route());
        }

        $viewdata = array();









        /*
        Bruger sender data
         - Validerer data indtil ingen fejl bliver fundet (inkl Email ikke allerede eksisterer)
        --- Hvis fejl returner View med fejl beskrivelse
         - Lav PasswordHash (inkl Salt) samt email validerings kode og indsæt data i databasen.
         - Send Email (angående validering)
         - Returner Success View

        */


        

        
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

                // Try to get the user by email
                $this->load->model('UserModel');
                $user = $this->UserModel->get_by_email($email);



                $user = null;



                // Check if found
                if ($user != null)  // ???
                {
                    // Check the password   - missing salt - create helper
                    $inputpasswordhash = hash('sha256', $password);
                    if ($inputpasswordhash === $user->passwordhash)
                    {
                        // Success

                        // Login
                        $authUser = new AuthenticatedUser($user->id, $user->email, $user->firstname, $user->lastname);
                        $this->authentication->login($authUser);

                        // Set status message
                        $this->session->set_flashdata('status', 'You have been logged in!');

                        // Redirct - returns immediatly
                        //redirect(usersearch_route());       // redirect to home instead ?
                    }
                }

                //$viewdata['status'] = 'Login was incorrect. Please try again.';
            }
        }

        

        // Default fallback
        
        $this->template->load('user/signup', $viewdata);
    }

    // Simple callback validator for the email - put it somewhere else (helper?)
    public function email_available($email)
    {
        // Set callback error message (could be set elsewhere - in cofig file)
        $this->form_validation->set_message('email_available', '%s is already signed up');

        $this->load->model('UserModel');
        return $this->UserModel->get_by_email($email) == null;
    }


    
    public function login()
    {
        // Check if already logged in - make helper
        if (get_user()->is_authenticated())
        {
            redirect (home_route());
        }

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

                // Check if found       
                if ($user != null)  // ???
                {
                    // Check the password   - missing salt - create helper
                    $inputpasswordhash = hash('sha256', $password);
                    if ($inputpasswordhash === $user->passwordhash)
                    {
                        // Success

                        // Login
                        $authUser = new AuthenticatedUser($user->id, $user->email, $user->firstname, $user->lastname);
                        $this->authentication->login($authUser);

                        // Set status message
                        $this->session->set_flashdata('status', 'You have been logged in!');

                        // Redirct - returns immediatly
                        //redirect(usersearch_route());       // redirect to home instead ?
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

        redirect(home_route());   // redirect to url referer instead ?
    }





    
    public function validate($code)
    {
        // if there is no code present with form field where the code can be entered ?
        // Create UserActivate model and check for post ?

        $model;

        if ($_POST)
        {
            // $model = Get UserActivate model
            // Or just get the activation code directly from input->post()? remember to escape data in the service then
        }
        else
        {
            // Make sure the code is present ? - if not just return view with form field
            
            // $model = new UserActivate($code);
        }


        
        // Get UserService
        // Call UserService->Activate(UserActivate)     // UserActivationCode?
            // Check the result returned

        // If valid return to home and use flash_data to show message that you have been activated ?
        // Or show success page by redirecting !

        // Dont login directly - redirect to login page instead

        // If not valid return view including errors in viewdata - same as if code is not present
    }


    
    public function search()
    {
        // Ensure user is autorized
        ensure_authorized();

        

        // Post check

        // Search mangler i menuen når logged in - skal være der sammen med logout istedet for login og create user

        $this->template->load('user/search');
    }
}