<?php

// Rename folder to misc ?

class Layout_model extends CI_Model
{
    //var $head = array();
    var $title = '';

    function __construct()
    {
        parent::__construct();
    }


    // add_to_head metode ? add_head_element? 
    // get_head_elements ?
    // user object mm ? helper metoder til logged in ?


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
