<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IImageService.php';

class ImageService implements IImageService
{
    // Private fields
    protected $CI;
    protected $profile_cfg;
    protected $thumbnail_cfg;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load upload library
        $this->CI->load->library('image_lib');

        // Load configuration
        $this->profile_cfg = $config["profile"];
        $this->thumbnail_cfg = $config["thumbnail"];
    }

    public function get_errors()
    {
        return $this->CI->image_lib->display_errors();
    }
   
    public function generate_profile_image($source)
    {
        $profilecfg = $this->profile_cfg;
        $thumbcfg = $this->thumbnail_cfg;

        $profilecfg['source_image'] = $source;
        $thumbcfg['source_image'] = $source;

        // Generate profile picture
        $result = $this->generate_image($profilecfg);

        // Generate thumbnail picture
        $result = $result ? $this->generate_image($thumbcfg) : FALSE;

        return $result;
    }

    private function generate_image($config)
    {
        // Clear
        $this->CI->image_lib->clear();

        // Init
        $this->CI->image_lib->initialize($config);

        // Resize
        return $this->CI->image_lib->resize();
    }
}

?>