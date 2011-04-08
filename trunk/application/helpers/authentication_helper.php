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

function ensure_authorized()
{
    // Fix
    // Should be able to save url refer when it happens, so it can go back to the page which the user tried to visit

    $user = get_user();
    if (!$user->is_authenticated())
    {
        $CI =& get_instance();
        $CI->session->set_flashdata('status', 'You are not allowed to view the page. Please login.');

        // return immediatly
        redirect(login_route());
    }
}

?>