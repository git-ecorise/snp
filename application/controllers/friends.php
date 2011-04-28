<?php

class friends extends CI_Controller {

    function  __construct() {
        parent::__construct();
    }

    public function index()
    {
        //get all friends for logged_in user
        $this->load->model('ProfileUserModel');

        $data['friends'] = $this->ProfileUserModel->get_all_user_friends(get_user()->get_id());

        $this->template->load('settings/friends', $data);
    }

    public function addfriend($id)
    {
        $this->load->model('ProfileUserModel');
        $this->ProfileUserModel->add_friend($id, get_user()->get_id());

        //set flashdata
        $this->session->set_flashdata('status', 'friend has been added');

        return redirect('friends/index');
    }

    public function friends()
    {
        //get all friends for logged_in user
        $this->load->model('ProfileUserModel');

        $data['friends'] = $this->ProfileUserModel->get_all_user_friends(get_user()->get_id());

        $this->template->load('settings/friends', $data);
    }
}
?>
