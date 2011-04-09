<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'iTemplate.php';

class Template implements iTemplate
{
    // Private fields
    private $prefix = '';
    
    // Protected fields
    protected $CI;
    protected $master;
    protected $model = null;
    protected $data = array();
    protected $viewkey;
    protected $modelkey;

    function __construct($config = array())
    {
        // Get CodeIginiter reference
        $this->CI =& get_instance();

        // Load Configuration
        $this->prefix = $config['prefix'];
        $this->master = isset ($config['master']) ? $config['master'] : '';
        $modelname = isset ($config['model']) ? $config['model'] : '';

        // Set keys
        $this->viewkey = $this->prefix . 'view';
        $this->modelkey = $this->prefix . 'model';

        // Load model if defined
        if ($modelname != '')
        {
            $this->CI->load->library($modelname, array(), $this->modelkey);
            $this->model = $this->CI->{$this->modelkey};
        }
    }

    function load($view = '', $view_data = array(), $return = FALSE)
    {
        // Prepare data for template
        $this->data[$this->modelkey] = $this->model;

        // Make template model available to the view
        $view_data[$this->modelkey] = $this->model;

        // Load the view
        $viewcontent = $this->CI->load->view($view, $view_data, TRUE);
        
        // Make view available to the template
        $this->data[$this->viewkey] = $viewcontent;

        // Load and return
        return $this->CI->load->view($this->master, $this->data, $return);
    }

    // Getter and Setters

    public function get_prefix()
    {
       return $this->prefix;
    }

    public function get_master()
    {
       return $this->master;
    }

    public function set_master(String $master)
    {
       $this->master = $master;
    }

    public function get_model()
    {
       return $this->model;
    }

    public function set_model(CI_Model $model)
    {
       $this->model = $model;
    }

    public function get_data()
    {
       return $this->data;
    }

    function set_data($data = array(), $value = '')
    {
        // Supports both name/value or array as parameter

        if (is_string($data))
        {
            $this->data[$data] = $value;
        }
        else if (count($data) > 0)
        {
            $this->data = array_merge($this->data, $data);
        }
    }
}

?>