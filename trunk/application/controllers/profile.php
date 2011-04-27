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

    public function resetpassword()
    {
        if($_POST)
        {
            //post request
            

        }

        $this->teplate->load('profile/reset');
        //default fallback
    }

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

    public function interests()
    {
        if($_POST)
        {
            //TODO: add input validation
            
            $this->load->helper('misc_helper');
            //gets the interests from the request
            $interests = $this->input->post('interests');
            
            //explodes the string into array
            $interests = procesTags($interests);

            //update interest in database
            $this->load->Model('InterestUserModel');
            $this->InterestUserModel->update_interests($interests, get_user()->get_id());

            //set flashdata message
            $this->session->set_flashdata('status', 'Your interests have been saved<br/>');

            //redirect to profile main page
            return redirect(my_profile_route());
        }

        $this->load->model('InterestUserModel');
        $data['interests'] = $this->InterestUserModel->user_interests_toString(get_user()->get_id());
        $data['action'] = add_interests_route();
        $data['submit_value'] = "Save";
        //default fallback
        $this->template->load('profile/addInterestView', $data);
    }

    public function searchinterests()
    {
        if($_POST)
        {
            //get input from form
            $interests = $this->input->post('interests');

            //seperate string into array
            $this->load->helper('misc_helper');
            $terms = procesTags($interests);

            //load model
            $this->load->model('InterestUserModel');

            //do search after friends with common interests
            $friends = $this->InterestUserModel->search_friends_by_interests($terms);

            $data['friends'] = $friends;
        }
        //set action method for form in partial view
        $data['action'] = search_interests_route();
        $data['submit_value'] = "Search";

        //default fallback
        $this->template->load('profile/searchInterestView', $data);
        
        
    }

    public function ajax_interests($term)
    {
        $this->load->model('InterestUserModel');
        $result = $this->InterestUserModel->search_interests_by_term($term);
        return print json_encode($result);
    }

    public function addfriend($id)
    {
        $this->load->model('ProfileUserModel');
        $this->ProfileUserModel->add_friend($id, get_user()->get_id());

        //set flashdata
        $this->session->set_flashdata('status', 'friend has been added');

        return redirect('profile/friends');
    }

    public function friends()
    {
        //get all friends for logged_in user
        $this->load->model('ProfileUserModel');
        
        $data['friends'] = $this->ProfileUserModel->get_all_user_friends(get_user()->get_id());

        $this->template->load('profile/friends', $data);
    }

    

}

?>
