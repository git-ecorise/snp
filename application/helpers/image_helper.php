<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function thumbnail_default_image()
{
    return image_content('_default.jpg');      // Korrekte navn ?
}

function profile_default_image()
{
    return image_content('_default.jpg');      // Korrekte navn ?
}

function thumbnail_image($id)
{
    return image_content($id . '/thumbnail.jpg');       // img/id/thumbnail.jpg
}

function profile_image($id)
{
    return image_content($id . '/profile.jpg');
}

function select_thumbnail_image($id, $hasimage)
{
    if ($hasimage)
        return thumbnail_image($id);
    else
        return thumbnail_default_image();
}

function select_profile_image($id, $hasimage)
{
    if ($hasimage)
        return profile_image($id);
    else
        return profile_default_image ();
}

?>