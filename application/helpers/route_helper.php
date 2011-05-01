<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// USER

function home_route()
{
    if (is_authenticated())
        return profile_route();

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

function reset_password_admin_route($id)
{
    return site_url('user/resetpasswordadmin/' . $id);
}

function reset_password_success_route()
{
    return site_url('user/resetpasswordsuccess');
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

// SETTINGS

function settings_route()
{
    return site_url('settings');
}

function settings_edit_route($id = "")
{
    if($id == "")
    {
        return site_url('settings/edit');
    }
    else
    {
        return site_url('settings/edit/'.$id);
    }
    
}

function upload_image_route()
{
    return site_url('settings/uploadimage');
}

// INTERESTS

function interests_edit_route()
{
    return site_url('interests');
}

function interests_search_route()
{
    return site_url('interests/search');
}

// FRIENDS

function friends_route()
{
    return site_url('friends');
}

function friends_add_route($id, $profile = FALSE)
{
    return site_url('friends/add/'.$id . '/'.$profile);
}


function usersearch_route()
{
    return site_url('user/search');
}

function my_profile_route()
{
    return site_url('profile');
}

function friend_profile_route($id)
{
    return site_url('profile/'.$id);
}

function profile_route($id = "")
{
    if($id == "")
    {
        return site_url('profile');
    }
    else
    {
        return site_url('profile/index/'.$id);
    }
}

function profile_thumbnail_route($picture_url = '')
{
    return site_url('content/img/uploads/thumbs/'.$picture_url);
}

function add_comment_route()
{
    return site_url('profile/add_comment/');
}

function update_status_route()
{
    return site_url('profile/update_status/');
}

?>