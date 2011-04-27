<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {

    public function  __construct() {
        parent::__construct();

        //check if user is logged in
        if( !is_authorized() )
        {
            //set flash data
            $this->session->set_flashdata('status', 'Your have to be logged in to view this page!');

            //redirect to login page
            redirect(login_route());
        }
    }

    public function index() {
        $this->template->load('profile/myprofile');
    }

    public function uploadpicture()
    {
        if ($_POST) {
            
            if(!$this->do_upload())
            {
                $this->session->set_flashdata('status', 'Something went wrong with your upload');
            }
            else
            {
                $this->session->set_flashdata('status', 'You have uploaded your picture');
            }

            return redirect(my_profile_route());
        }
        else
        {
            $this->template->load('profile/uploadpicture');
        }
    }

    public function edit()
    {
        if($_POST)
        {
            //Post request

            // Set delimiters - hide this away (extend controller etc...)
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            //validate form
            if ($this->form_validation->run('updateprofile'))
            {
                //get the values from the form
                $id = $this->input->post('id');
                $email = $this->input->post('email');
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $city = $this->input->post('city');
                $zip = $this->input->post('zip');
                $country = $this->input->post('country');
                
                //updates the user
                $this->load->model('UserModel');
                $this->UserModel->update($email, array(
                    //it fucks up if one tries to edit email
                    //why ??
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'city' => $city,
                    'zip' => $zip,
                    'country' => $country
            ));

            //success confirm message to user
            $this->session->set_flashdata('status', 'Your changes have been saved');

            //redirects
            return redirect(my_profile_route());
            }

        }
            $this->load->model('UserModel');
            
            //get AuthUser by email
            $viewdata['user'] = $this->UserModel->get_by_email(get_user()->get_email());

            //default fallback
            $this->template->load('profile/edit', $viewdata);
   
    }
}

?>
