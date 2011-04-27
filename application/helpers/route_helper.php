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

function validate_route($email = '', $code = '')
{
    $segments = array('user', 'validate');

    if ($email != '' && $code != '')
    {
        $segments[] = urlencode($email);
        $segments[] = $code;
    }

    return site_url($segments);
}

function resetpassword_route($email = '', $code = '')
{
    $segments = array('user', 'resetpassword');

    if ($email != '' && $code != '')
    {
        $segments[] = urlencode($email);
        $segments[] = $code;
    }

    return site_url($segments);
}

function signup_success_route()
{
    return site_url('user/signupsuccess');
}

?>