<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function home_route()
{
    return base_url();
}

function signup_route()
{
    return site_url('user/signup');
}

function login_route()
{
    return site_url('user/login');
}

function logout_route()
{
    return site_url('user/logout');
}

function usersearch_route()
{
    return site_url('user/search');
}

?>