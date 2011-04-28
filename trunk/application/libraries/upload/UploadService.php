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
        $this->load->library('upload');
    }

    public function get_errors()
    {
        return $this->CI->upload->display_errors();
    }

    public function get_upload_data()
    {
        return $this->CI->upload();
    }

    public function recieve_profile_image_upload($id)
    {
        // lad upload service bruge image resize service !?!?!??!

        

        // Should it update the database ? NO !?

        // Should do some temp stuff and not move before success ?
        // Tilføj extensions til filnavn her ?


        // gem først som temp i en temp mappe eller lignende ? og lad derefter flytte ?



        // Setup configuration
        // Include id in upload_path and get folder name
        $config = $this->profile_image_cfg;
        $folder = $config["upload_path"] . $id . '/';
        $config["upload_path"] = $folder;

        echo folder . '<---- FOLDER IS HERE';

        // Find out if folder already exists
        if(file_exists($folder))
        {
            // Exists - delete folder and all content

            
            //rmdir($folder);
        }

        // Try to create folder     // is it even needed - will upload do it for me ?
        //if (!mkdir($folder))
        //    return false;


        
        // Init
        $this->CI->upload->initialzie($config);     

        // Recieve the upload and return result
        return $this->CI->upload->do_upload();
    }
}

?>