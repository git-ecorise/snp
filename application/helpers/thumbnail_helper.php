<?php
function profile_thumbnail($picture_url)
{
    //set default picture
    $file_path = profile_thumbnail_route($picture_url);
    $default_path = profile_thumbnail_route('_default.jpg');

    //check if user has uploaded a profile picture
    if($picture_url == "" OR $picture_url == NULL)
    {
        return $default_path;
    }
    else
    {
        //works, but should be optimized without a hardcoded path
        if(!file_exists('content/img/uploads/thumbs/'.$picture_url))
        {
            return $default_path;
        }
        else
        {
            return $file_path;
        }
    }
}
?>
