<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller
{
   public function  __construct()
    {
        parent::__construct();

        // Ensure user is authorized - all actions
        ensure_authenticated();
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
