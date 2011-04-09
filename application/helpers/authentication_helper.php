<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'libraries/authentication/AuthenticatedUser.php');
require_once(APPPATH . 'libraries/authentication/DefaultUser.php');
require_once 'route_helper.php';

// Refactor this sometime
// How do i fix the require_once ? not optimal that specific types have to be loaded

function get_user()
{
    $CI =& get_instance();
    //$CI->load->library('authentication/Authentication');

    // Fix !
    
    return $CI->authentication->get_user();
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

?>