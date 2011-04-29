<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IImageService
{
    public function get_errors();

    public function generate_profile_image($data);
    public function generate_thumbnail_image($data);
}

?>
