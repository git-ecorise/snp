<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function create()
    {
        if($_POST)
        {
            //creates a user object
            //this should NOT be done here!
            //only for test purposes
            $user = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname')
            );

            //create the user
            $data['message'] = $this->userservice->create($user) == TRUE ? "User created" : "User not created";
           
            $this->load->vars($data);
            $this->template->load('user/create_confirm');
        }
        else
        {
            $this->template->load('user/create');
        }
    }

    public function login()
    {
        if($_POST)
        {
            //for test purposes
            //this should be a real object
            $login_user = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password')
            );

            //try to login
            if($this->userservice->login($login_user))
            {
                //sorry jeg er træt og vil gå i seng
                print "hurray";
            }
            else
            {
                print "bummer";
            }
        }
        else
        {
            $this->template->load('user/login');
        }
        
    }

    public function logout()
    {
        redirect(home_route(),'refresh');
    }

    public function validate($code)
    {
    }
}