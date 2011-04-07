<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function home_route()
{
    return base_url();
}

function createuser_route()
{
    return site_url('user/create');
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