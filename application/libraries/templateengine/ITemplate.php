<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

interface ITemplate
{
    public function load($view = '', $view_data = array(), $return = FALSE);

    // Getter and Setters

    public function get_prefix();

    public function get_master();
    public function set_master($master);

    public function get_model();
    public function set_model($model);

    public function get_data();
    public function set_data($data = array(), $value = '');
}

?>
