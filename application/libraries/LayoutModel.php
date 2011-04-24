<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Not much here yet - extend it with whatever you need to use in the layout template

// Move ? to models / view / shared ? - should change templateengine and config - where model is located.

// extend CI_Model ?

class LayoutModel
{
    private $title = '';

    public function __construct()
    {
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
