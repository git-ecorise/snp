<?php

// Rename folder to misc ?

// add_to_head metode ? add_head_element?
// get_head_elements ?
// user object mm ? helper metoder til logged in ?

// use methods set / get_title ? or allow direct access via public ? - fix in all views
// also fix the identifier

// Fix name to LayoutModel ?


// Not much here yet - extend it with whatever you need to use in the layout template

class Layout_model extends CI_Model
{
    private $title = '';

    function __construct()
    {
        parent::__construct();
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
