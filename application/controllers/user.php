<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function create()
    {
        $this->load->view('welcome_message');
    }

    public function login()
    {
        $this->load->view('welcome_message');
    }

        public function logout()
    {
        $this->load->view('welcome_message');
    }
}