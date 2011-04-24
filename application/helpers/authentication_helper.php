<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Remmber later on there can be a difference between been authenticated and authorized

function get_user()
{
    $CI =& get_instance();   
    return $CI->authenticationservice->get_user();
}

function is_authorized()
{
    // Currently just requires user is authenticated to be authroized
    $user = get_user();
    return $user->is_authenticated();
}

function ensure_authorized()
{
    if (!is_authorized())
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