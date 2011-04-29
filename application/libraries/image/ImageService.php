<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'IImageService.php';

class ImageService implements IImageService
{
    // Private fields
    protected $CI;
    protected $profile_image_cfg;
    protected $thumbnail_image_cfg;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load upload library
        $this->CI->load->library('image_lib');

        // Load configuration
        $this->profile_image_cfg = $config["profile_image"];
        $this->thumbnail_image_cfg = $config["thumbnail_image"];
    }

    public function get_errors()
    {
        return $this->CI->image_lib->display_errors();
    }



    
    private function do_resize($image_data)
    {
        $config = array(
            'source_image' => $image_data['full_path'],
            'new_image' => 'content/img/uploads/thumbs/',
            'maintain_ratio' => TRUE,
            'master_dim' => 'auto',
            'width' => 200,
            'height' => 200     // kun witdth .. ingen height ... på profile ?
        );

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }



    // Resize
    // Billeder

    // Admin

    // Rapport


    // CLEAN UP ALL COMMENTS .... ! MOVE AROUND STUFF !? 


    
    public function generate_profile_image($data)
    {
        // pass in full_path instead?
        // destination path / + file name = or create it here ... just pass it to the create image ?
        


        $this->CI->image_lib->clear();

        //$config = $this->profile_image_cfg;


        echo $data['full_path'] . '<--- FULL PATH !!!!!!!!!';

        
        $config = array(
            
            'source_image' => $data['full_path'],
            'new_image' => 'profile.jpg',      // only name will place it in same folder as original
            'create_thumb' => TRUE,                                     // LAVER DEN BÅDE THUMB OG NEW ?

            'maintain_ratio' => TRUE,
            'master_dim' => 'auto',
            //'quality' => '90',
            'width' => 200,
            'height' => 200     // kun witdth .. ingen height ... på profile ?
        );


        // fix name osv ...
        // istedet for config .. kan man så ikke baer have noget hardcoded ?

        // lav en private metode der klarer det ? 

        $this->CI->image_lib->initialize($config);



        // kald resize---

        $this->CI->image_lib->resize()


        // clear ?
    }

    public function generate_thumbnail_image($data)
    {
        $this->CI->image_lib->clear();

        $config = $this->thumbnail_image_cfg;



        
        $this->CI->image_lib->initialize($config);
    }


    private function generate_image($folder)
    {
        $this->CI->image_lib->clear();

        // settings ind? config ?

        //
    }
}

?>