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


    // Resize
    // Billeder

    // Admin

    // Update profile kager fuldstændig i det ... formentlig where sætning ... opdaterer alle brugerer med navn

    // Rapport


    // CLEAN UP ALL COMMENTS .... ! MOVE AROUND STUFF !? 


    
    public function generate_profile_image($data)
    {
        // pass in full_path instead?
        // destination path / + file name = or create it here ... just pass it to the create image ?

        if ($data['is_image'])
        {

            // fix name osv ...
            // istedet for config .. kan man så ikke baer have noget hardcoded ?

            // lav en private metode der klarer det ?



            $this->CI->image_lib->clear();
            $profilecfg = $this->profile_cfg;
            $thumbcfg = $this->thumbnail_cfg;

            $target = $data['full_path'];


            
            $profilecfg['source_image'] = $target;
            $thumbcfg['source_image'] = $target;


            echo $data['full_path'] . '<--- FULL PATH !!!!!!!!!';


            

            // Generate profile picture
            $result = $this->generate_image($profilecfg);

            // Generate thumbnail picture
            $result = $result ? $this->generate_image($thumbcfg) : FALSE;

            return $result;
        }

        return false;
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