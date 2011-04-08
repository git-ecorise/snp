<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Remember controller actions should only dictate the flow
// Use PRG pattern

class User extends CI_Controller
{
    public function signup()
    {
        //$tmpl = new Template(array('master' => 'shared/_layout'));
        //$data = $tmpl->load('home/index', array(), TRUE);
        //echo $data;


        /*
        Bruger sender data
         - Validerer data indtil ingen fejl bliver fundet (inkl Email ikke allerede eksisterer)
        --- Hvis fejl returner View med fejl beskrivelse
         - Lav PasswordHash (inkl Salt) samt email validerings kode og indsæt data i databasen.
         - Send Email (angående validering)
         - Returner Success View

        */

        $this->template->load('user/signup');
    }


    
    public function login()
    {       
        if ($_POST)
        {
            // Post Request
            
            $this->load->library('services/UserService');
            $this->load->model('UserLogin');

            // Authenticate UserLogin and get Result
            $result = $this->userservice->authenticate($this->UserLogin);

            // Check Result
            if($result->is_success())
            {
                // Success

                $this->load->library('authentication/Authentication');


                


                
                // Get user from result->data (AuthenticatedUser)
                // or just get the data for the user from there in data ?

                $user = new AuthenticatedUser(1234, 'email@domain.com', 'Martin', 'From');       // get data from $result->data / model ?



                // Login
                $this->authentication->login($user);

                // Set status message
                $this->session->set_flashdata('status', 'You have been logged in!');

                // Redirct - returns immediatly
                redirect(usersearch_route());       // redirect to home instead ?
            }

            // Fail

            $data = array("model" => $this->userLogin,
                          "errors" => $result->get_errors());

            $this->session->set_flashdata('status', 'Login was incorrect. Please try again.');

            $this->template->load('user/login', $data);

            return; // could just continue - require that data is included in last load
        }

        // Get Request

        $this->template->load('user/login');
    }
  
    public function logout()
    {
        $this->load->library('authentication/Authentication');

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