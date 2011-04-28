<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IImageService.php';

class ImageService implements IImageService
{
    // Private fields
    protected $CI;
    protected $location;


    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load upload library
        $this->load->library('upload');

        // Load configuration
        $this->location = $config["location"];



        
        // accepted formats
        // størrelser

        // More - or just store the config array 
    }




    
}

?>