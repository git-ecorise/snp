<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->session->set_flashdata('status', 'Hello, and welcome!');
        
        $this->template->load("home/index");
    }
}