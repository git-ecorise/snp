<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class friends extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();

        // Make sure the user is authorized - all actions
        ensure_authenticated();
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

        // Set status message
        set_status_message('Friend have been added');

        return redirect('friends/');
    }



    // Hvad er forskellen på denne og index () !?!??!?!?! slet ?

    /*
    public function friends()
    {
        //get all friends for logged_in user
        $this->load->model('ProfileUserModel');

        $data['friends'] = $this->ProfileUserModel->get_all_user_friends(get_user()->get_id());

        $this->template->load('settings/friends', $data);
    }
    */
}

?>