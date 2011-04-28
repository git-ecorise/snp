<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface IUploadService
{
    public function get_errors();
    public function get_upload_data();

    public function recieve_profile_image_upload($id);
}

?>
