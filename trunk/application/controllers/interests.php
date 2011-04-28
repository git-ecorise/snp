<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class interests extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Make sure user is authorized to view the page
        ensure_authenticated();
        
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
            return redirect(settings_route());
        }

        $this->load->model('InterestUserModel');
        $data['interests'] = $this->InterestUserModel->user_interests_toString(get_user()->get_id());
        $data['action'] = edit_interests_route();
        $data['submit_value'] = "Save";
        //default fallback
        $this->template->load('settings/addInterestView', $data);
    }

    public function searchinterests()
    {
        // Make sure the user is authorized to view the page
        ensure_authenticated();

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
        $this->template->load('settings/searchInterestView', $data);

    }

    public function ajax_interests($term)
    {
        $this->load->model('InterestUserModel');
        $result = $this->InterestUserModel->search_interests_by_term($term);
        return print json_encode($result);
    }
}
?>
