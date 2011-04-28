<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// USER

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

function reset_password_success_route()
{
    return site_url('user/resetpasswordsuccess');           // Behold eller redirect direkte ?
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

function settings_edit_route()
{
    return site_url('settings/edit');
}

function upload_image_route()
{
    return site_url('settings/uploadimage');
}



// INTERESTS

function interests_edit_route()
{
    return site_url('interests');                   // burde være /interests/edit ??? - /interest/ burde bare være oversigt oversine interests ? hvro man kan slette ?
}

function interests_search_route()
{
    return site_url('interests/searchinterests');
}



// Friends

function friends_route()
{
    return site_url('friends');
}

function friends_add_route($id)
{
    return site_url('friends/add/'.$id);
}




// CLEAN UP !?!?!??!?!?!





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



function profile_thumbnail_route($picture_url = '')
{
    return site_url('content/img/uploads/thumbs/'.$picture_url);
}






function update_status_route()
{
    return site_url('profile/update_status/');
}

?>