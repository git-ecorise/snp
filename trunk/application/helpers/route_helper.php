<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function home_route()
{
    return base_url();
}

function signup_route()
{
    return site_url('user/signup');
}

function signup_success_route()
{
    return site_url('user/signupsuccess');
}

function login_route()
{
    return site_url('user/login');
}

function logout_route()
{
    return site_url('user/logout');
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

function reset_password_route()
{
    return site_url('user/resetpassword');
}

function change_password_route($email = '', $code ='')
{
    $segments = array('user', 'changepassword');

    if ($email != '' && $code != '')
    {
        $segments[] = urlencode($email);
        $segments[] = $code;
    }

    return site_url($segments);
}



function usersearch_route()
{
    return site_url('user/search');
}


function my_profile_route()
{
    return site_url('profile/index');
}

function profile_route()
{
    return site_url('profile/index');
}
function settings_route()
{
    return site_url('settings/index');
}

function upload_picture_route()
{
    return site_url('settings/uploadpicture');
}

function edit_profile_route()
{
    return site_url('settings/edit');
}

function profile_thumbnail_route($picture_url = '')
{
    return site_url('content/img/uploads/thumbs/'.$picture_url);
}

function reset_password_success_route()
{
    return site_url('user/resetsuccess');
}

function add_interests_route()
{
    return site_url('interests/index');
}

function search_interests_route()
{
    return site_url('interests/searchinterests');
}

function add_as_friend_route($id)
{
    return site_url('friends/addfriend/'.$id);
}

function update_status_route()
{
    return site_url('profile/update_status/');
}

?>