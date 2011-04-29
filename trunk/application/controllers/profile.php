<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller
{
   public function  __construct()
    {
        parent::__construct();

        // Ensure user is authorized - all actions
        ensure_authenticated();
    }

    public function index($id = "")
    {
        //Set userid
        $userid = get_user()->get_id();

        //check if id is sent with request and set userid
        if( $id != "")
        {
            $userid = $id;
        }

        //load models
        $this->load->model('StatusModel');
        $this->load->model('InterestUserModel');
        $this->load->model('ProfileuserModel');
        $this->load->model('user/UserModel');

        //load helper
        $this->load->helper('image_helper');

        //get all updates
        $data['updates'] = $this->StatusModel->get_all();

        //get the user
        $data['user'] = $this->UserModel->get_by_id($userid);

        //get the users interests
        $data['interests'] = $this->InterestUserModel->user_interests_toString($userid);

        //get users friends
        $data['friends'] = $this->ProfileuserModel->get_all_user_friends($userid);

        //load profile view
        $this->template->load('profile/index', $data);
    }

    public function update_status()
    {
        $status_update = $this->input->post('statusupdate');

        $this->load->model('StatusModel');

        $this->StatusModel->create($status_update, get_user()->get_id());
        $data['updates'] = $this->StatusModel->get_all();

        return redirect(profile_route());
    }
}

?>