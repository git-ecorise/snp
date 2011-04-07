<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Move interface to seperate file or delete ?

interface iTemplate
{
    public function load($view = '', $view_data = array(), $return = FALSE);

    // Getter and Setters

    public function get_prefix();

    public function get_master();
    public function set_master(String $master);

    public function get_model();
    public function set_model(CI_Model $model);

    public function get_data();
    public function set_data($data = array(), $value = '');
}



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

        // Load model if defined
        if ($modelname != '')
        {   
            $varname = $this->prefix . 'model';
            $this->CI->load->model($modelname, $varname);
            $this->model = $this->CI->{$varname};
        }

        // Set keys
        $this->viewkey = $this->prefix . 'view';
        $this->modelkey = $this->prefix . 'model';
    }

    function load($view = '', $view_data = array(), $return = FALSE)
    {
        // Prepare data for template
        $this->data[$this->modelkey] = $this->model;

        // Make template model available to the view
        $view_data[$this->modelkey] = $this->model;     
        // or make all template data available to the view ?
        //$this->CI->load->vars($this->data);
        // or move via push(), merge(), fill() ?
        $view_data = array_merge($view_data, $this->data);
        
        // Load the view
        $viewcontent = $this->CI->load->view($view, $view_data, TRUE);
        
        // Make view available to the template
        $this->data[$this->viewkey] = $viewcontent;

        // Load and return the template
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