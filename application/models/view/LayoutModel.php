<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LayoutModel //extends CI_Model
{
    private $title = '';

    public function __construct()
    {
        //parent::__construct();
    }

    // Getter and Setters

    public function get_title()
    {
        return $this->title;
    }

    public function set_title($title)
    {
        $this->title = $title;
    }
}

?>
