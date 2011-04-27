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

    public function index() 
    {
        $this->load->model('StatusModel');

        $data['updates'] = $this->StatusModel->get_all();

        $this->template->load('profile/index', $data);
    }

    public function update_status()
    {
        $status_update = $this->input->post('statusupdate');

        $this->load->model('StatusModel');

        $this->StatusModel->create($status_update, get_user()->get_id());
        $data['updates'] = $this->StatusModel->get_all();

        $this->template->load("profile/index", $data);
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

            $this->load->model('UserModel');
            //save the picture_url to db
            $this->UserModel->insert_picture_url(get_user()->get_id(), $data['upload_data']['file_name']);
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
}

?>
