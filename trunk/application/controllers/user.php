<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Remember controller actions should only dictate the flow
// Use PRG pattern

class User extends CI_Controller
{
    public function create()
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

        $this->template->load('user/create');
    }


    
    public function login()
    {       
        if ($_POST)
        {
            // Post request
            
            $this->load->library('services/UserService');
            $this->load->model('UserLogin');

            $result = $this->userservice->authenticate($this->UserLogin);

            if($result->is_success())
            {
                // Success

                // Set status message
                $this->session->set_flashdata('status', 'You have been logged in!');
                // Redirct
                redirect(usersearch_route());   // url referer instead ?
                return;
            }

            // Fail

            $data = array("model" => $this->userLogin,
                          "errors" => $result->get_errors());

            $this->session->set_flashdata('status', 'Login was incorrect. Please fix it!');

            $this->template->load('user/login', $data);
            return;
        }

        // Get Request

        $this->template->load('user/login');
    }


    
    public function logout()
    {
        $this->load->library('authentication/Authentication');
       $this->authentication->logout();

        // Set status message
        $this->session->set_flashdata('status', 'You have been logged out!');

        redirect(home_route());   // redirect to url referer instead (if protected it will redirect again) ?
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
        // require_authenticated metode (helper?) der blot tjekker om user is_authenticated og hvis ikke så redirecter den ? evt viser flashdata ?
        // 
        // Post check

        $this->template->load('user/search');
    }
}