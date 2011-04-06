<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function graphic_content($file)
{
    return base_url() . "content/gfx/" . $file;
}

function stylesheet_content($file)
{
    return base_url() . "content/css/" . $file;
}

function javascript_content($file)
{
    return base_url() . "content/js/" . $file;
}

function image_content($file)
{
    return base_url() . "content/img/" . $file;
}

?>
