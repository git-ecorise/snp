<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function create()
    {
        $this->load->view('home/index');
    }

    public function login()
    {
        $this->load->view('home/index');
    }

        public function logout()
    {
        $this->load->view('home/index');
    }
}