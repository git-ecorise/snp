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



    // Når det her er lavet så lav så admin kan resette password og opdaterer profil
    // Så er all done reelt set ...


    
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

                // Create thumnail and profile image
                // Update database

                $this->do_resize($this->uploadservice->get_upload_data());

                // Update user in database
                $this->load->model('ProfileUserModel','model');
                $this->model->insert_picture_url(get_user()->get_id(), $data['upload_data']['file_name']);


                
                // Also need to update current logged in user ! <- hasimage = true !



                set_status_message('Your picture have been uploaded');
                
                return redirect(settings_route());  // route is wrong - go to profile instead or ?
            }

            // Fail

            // Show error message about what went wrong...
            // use status message or display some form like error in red ?

            set_status_message('Something went wrong with your upload', $viewdata);

            $viewdata["errors"] = $this->uploadservice->get_errors();       // use for something in view ? add to viewdata
        }

        // Fallback
        $this->template->load('settings/uploadimage', $viewdata);
    }




    // upload service
        // recieve_image_upload()       // laver settings for upload og kalder CI upload->do_upload()
            // Sørger for at oprette mappe til billederne hvis ikke allerede eksisterer

    




    //move to image-service
    private function do_upload()
    {
        $config['upload_path'] = 'content/img/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000';
        $config['max_width'] = '102400';
        $config['max_height'] = '768000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload())
        {
            $data = array('error' => $this->upload->display_errors());
            return false;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $image_data = $this->upload->data();
            $this->do_resize($image_data);

            $this->load->model('ProfileUserModel','model');
            
            //save the picture_url to db
            $this->model->insert_picture_url(get_user()->get_id(), $data['upload_data']['file_name']);
            return true;
        }
    }

    //move to image-service
    private function do_resize($image_data)
    {
        $config = array(
            'source_image' => $image_data['full_path'],
            'new_image' => 'content/img/uploads/thumbs/',
            'maintain_ratio' => TRUE,
            'master_dim' => 'auto',
            'width' => 200,
            'height' => 200
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }




    public function edit()
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
            set_status_message('Your changes have been saved');

            //redirects
            return redirect(settings_route());
            }

        }

        // Get authenticated user by email
        $this->load->model('user/UserModel', 'UserModel');
        $viewdata['user'] = $this->UserModel->get_by_email(get_user()->get_email());

        // default fallback
        $this->template->load('settings/edit', $viewdata);
    }
}

?>
