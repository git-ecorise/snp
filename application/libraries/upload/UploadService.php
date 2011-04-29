<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IUploadService.php';

class UploadService implements IUploadService
{
    // Protected fields
    protected $CI;
    protected $profile_image_cfg;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load configuration
        $this->profile_image_cfg = $config["profile_image"];

        // Load upload library
        $this->CI->load->library('upload');
    }

    public function get_errors()
    {
        return $this->CI->upload->display_errors();
    }

    public function get_upload_data()
    {
        return $this->CI->upload->data();
    }

    public function recieve_profile_image_upload($id)
    {
        // Setup configuration
        // Include id in upload_path and get folder name
        $config = $this->profile_image_cfg;
        $folder = $config["upload_path"] . $id . '/';
        $config["upload_path"] = $folder;

        // Create folder
        $this->create_empty_folder($folder);

        // Init
        $this->CI->upload->initialize($config);

        // Recieve the upload and return result
        return $this->CI->upload->do_upload();
    }

    protected function create_empty_folder($folder)
    {
        // Find out if folder already exists
        if(file_exists($folder))
        {
            // Exists - delete folder and all content
            // $this->rrmdir($folder);

            return;
        }

        // Try to create folder
        if (!mkdir($folder))
            return false;
    }
}

?>