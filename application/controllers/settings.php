<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();

        // Make sure user is authorized - all actions
        ensure_authenticated();
    }

    public function index() {
        $this->template->load('settings/index');
    }

    public function uploadimage()
    {
        if ($_POST) {

            if(!$this->do_upload())
            {
                set_status_message('Something went wrong with your upload');
            }
            else
            {
                set_status_message('Your picture have been uploaded');
            }

            return redirect(settings_route());
        }
        else
        {
            $this->template->load('settings/uploadimage');
        }
    }

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
            $this->session->set_flashdata('status', 'Your changes have been saved');

            //redirects
            return redirect(settings_route());
            }

        }
            $this->load->model('user/UserModel', 'UserModel');
            
            //get AuthUser by email
            $viewdata['user'] = $this->UserModel->get_by_email(get_user()->get_email());

            //default fallback
            $this->template->load('settings/edit', $viewdata);
    }
}

?>
