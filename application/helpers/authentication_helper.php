<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Remmber later on there can be a difference between been authenticated and authorized

function get_user()
{
    $CI =& get_instance();   
    return $CI->authenticationservice->get_user();
}

function is_admin()
{
    return get_user()->is_admin();
}

function is_authenticated()
{
    return get_user()->is_authenticated();
}

function ensure_authenticated()
{
    if (!is_authenticated())
    {
        $CI =& get_instance();
        $CI->session->set_flashdata('status', 'You are not allowed to view the page. Please login.');
        // returns immediatly
        redirect(login_route());
    }
}

function redirect_if_authenticated($status = '')
{
    if (get_user()->is_authenticated())
    {
        if ($status != '')
        {
            $CI =& get_instance();
            $CI->session->set_flashdata('status', $status);
        }
        
        // returns immediatly
        redirect (home_route());
    }
}

?>