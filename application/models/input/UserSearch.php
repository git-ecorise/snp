<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'InputModel.php';

class UserSearch extends InputModel
{
    // Private fields
    private $name;

    function __construct()
    {
        parent::__construct('search');

        // Load data
        $this->name = $this->input->post('name');
    }

    public function get_name()
    {
        return $this->email;
    }
}

?>