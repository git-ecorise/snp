<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function create()
    {
        $this->template->load('user/create');
    }

    public function login()
    {       
        $this->template->load('user/login');
    }

    public function logout()
    {
        redirect(home_route(),'refresh');
    }

    public function validate($code)
    {
    }
}