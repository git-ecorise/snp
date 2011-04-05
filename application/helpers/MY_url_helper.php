<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function home_url()
{
    return base_url();
}

function createuser_url()
{
    return site_url('user/create');
}

function login_url()
{
    return site_url('user/login');
}

function logout_url()
{
    return site_url('user/logout');
}

?>