<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    // Private fields
    var $CI;
    var $master = '';
    var $data = array();

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load Configuration
        $this->master = $config['default_template'];
    }

    function set_master($master)
    {
        $this->master = $master;
    }

    // Supports both name/value or array as parameter
    function set_data($data = array(), $value = '')
    {
        if (is_string($data))
        {
            $this->data[$data] = $value;
        }
        else if (count($data) > 0)
        {
            $this->data = array_merge($this->data, $data);
        }
    }

    function load($view = '', $view_data = array(), $return = FALSE)
    {       
        $this->set_data('template_view', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($this->master, $this->data, $return);
    }    
}

?>
