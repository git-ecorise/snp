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
        $this->load->model('InterestUserModel');
        $this->load->model('ProfileuserModel');

        $data['updates'] = $this->StatusModel->get_all();
        $data['interests'] = $this->InterestUserModel->user_interests_toString(get_user()->get_id());
        $data['friends'] = $this->ProfileuserModel->get_all_user_friends(get_user()->get_id());

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
