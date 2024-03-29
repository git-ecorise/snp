<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();

        // Make sure user is authorized - all actions
        ensure_authenticated();
    }

    public function index()
    {
        $this->template->load('settings/index');
    }

    public function uploadimage()
    {
        $viewdata = array();

        if ($_POST)
        {
            $this->load->library('upload/UploadService');

            // Try to Recieve the image
            if ($this->uploadservice->recieve_profile_image_upload(get_user()->get_id()))
            {
                // Success

                $data = $this->uploadservice->get_upload_data();

                // Check if it is an image
                if ($data['is_image'])
                {
                    // Create images
                    $this->load->library('image/ImageService');
                    $this->imageservice->generate_profile_image($data['full_path']);

                    // Updated user
                    $this->update_user(TRUE);

                    // Show confirmation
                    set_status_message('Your image have been uploaded');

                    return redirect(profile_route());
                }
                else
                {
                    $this->update_profile_image(FALSE);
                }
            }
            
            // Fail
            set_status_message('Something went wrong with your upload', $viewdata);
        }

        // Fallback
        $this->template->load('settings/uploadimage', $viewdata);
    }

    private function update_user($hasimage)
    {
        $user = get_user();
        if ($user->has_image() != $hasimage)
        {
            // Update user in database
            $this->load->model('ProfileUserModel','model');
            $this->model->update_profile_image_status(get_user()->get_id(), $hasimage);

            // Update user object
            $user->set_has_image($hasimage);
            $this->authenticationservice->login($user);
        }
    }

    public function edit($id = "")
    {
        // Should work with is_admin -> should be allowed to change settings for everyone
        
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
                $this->load->model('user/UserModel', 'UserModel');
                $this->UserModel->update($id, array(
                    //it fucks up if one tries to edit email
                    //why ??
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'city' => $city,
                    'zip' => $zip,
                    'country' => $country
            ));

            //success confirm message to user
            set_status_message('Your changes have been saved');

            //redirects
            return redirect(settings_route());
            }

        }
        //Set userid
        $userid = get_user()->get_id();

        //check if id is sent with request and set userid
        if( $id != "")
        {
            $userid = $id;
        }

        // Get authenticated user by email
        $this->load->model('user/UserModel', 'UserModel');
        $viewdata['user'] = $this->UserModel->get_by_id($userid);

        // default fallback
        $this->template->load('settings/edit', $viewdata);
    }
}

?>