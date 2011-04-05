<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function create()
    {
        $this->load->view('user/create');
    }

    public function login()
    {
        $this->load->view('user/login');
    }

    public function logout()
    {
        // Remove cookie
        // Redirect - display referer url ?
    }
}