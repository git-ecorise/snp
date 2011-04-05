<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view("shared/_layout"); // change this to "home/index" when layout/template system is implemented
    }
}