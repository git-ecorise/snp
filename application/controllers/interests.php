<?php

class interests extends CI_Controller{

    function  __construct() {
        parent::__construct();
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
}
?>
