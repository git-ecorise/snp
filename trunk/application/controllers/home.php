<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model('StatusModel');
        
        $data['updates'] = $this->StatusModel->get_all();

        $this->template->load("home/index", $data);
    }

    public function update_status()
    {
        $status_update = $this->input->post('statusupdate');

        $this->load->model('StatusModel');

        $this->StatusModel->create($status_update, get_user()->get_id());
        $data['updates'] = $this->StatusModel->get_all();

        $this->template->load("home/index", $data);
    }
}