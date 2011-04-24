<?php

// Not much here yet - extend it with whatever you need to use in the layout template

// Move ? to models ? view model ? /view/shared ?
// extend CI_Model ? or not really needed ? - use load->model to load in template engine ? 

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
