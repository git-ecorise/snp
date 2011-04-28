<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IImageService.php';

class ImageService implements IImageService
{
    // Private fields
    private $location;


    function __construct($config = array())
    {
        // Load configuration
        $this->location = $config["location"];

        // More - or just store the config array 
    }
}

?>