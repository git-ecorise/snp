<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// The original code is poorly designed which makes it impossible to hook into the original functions without having to duplicate the code.

class EXT_Form_validation extends CI_Form_validation
{
    protected $_callbackObj;

    function __construct($config = array())
    {        
        parent::__construct($config);

        // Default let callback happen on the CI instance
        $this->_callbackObj = $this->CI;
    }

    public function set_callback_object($callbackObj)
    {
        $this->_callbackObj = $callbackObj;
    }

    public function has_errors()
    {
        // has_errors ? is_valid?

        return !empty($this->_error_array);
        //return count($this_error_array) > 0;
    }

    public function contains_error($key)
    {
        return isset ($this->_error_array[$key]);
    }

    public function add_error($key, $error)
    {
        $this->_error_array[$key] = $error;
        $this->_field_data[$key]['error'] = $error;
    }

    private function get_setting_value($setting, $key)
    {
        $pattern = "/^" . $key . "=\{(.*)\}$/";
        if (preg_match($pattern, $setting, $match))
            return $match[1];

        return FALSE;
    }

    private function get_modelname($str)
    {
        $segments = explode('/', $str);
        if ($segments)
        {
            return $segments[count($segments)-1];
        }

        return $str;
    }


    
    // ----------------------------------------------------------------------------------------------------
    // The part below is from the original Form_valiation
    // It is modified to use the callback object when calling the callback functions

    /**
     * Executes the Validation routines
     *
     * @access	private
     * @param	array
     * @param	array
     * @param	mixed
     * @param	integer
     * @return	mixed
     */
    function _execute($row, $rules, $postdata = NULL, $cycles = 0)
    {
        // If the $_POST data is an array we will run a recursive call
        if (is_array($postdata))
        {
                foreach ($postdata as $key => $val)
                {
                        $this->_execute($row, $rules, $val, $cycles);
                        $cycles++;
                }

                return;
        }

        // --------------------------------------------------------------------

        // If the field is blank, but NOT required, no further tests are necessary
        $callback = FALSE;
        if ( ! in_array('required', $rules) AND is_null($postdata))
        {
                // Before we bail out, does the rule contain a callback?
                if (preg_match("/(callback_\w+)/", implode(' ', $rules), $match))
                {
                        $callback = TRUE;
                        $rules = (array('1' => $match[1]));
                }
                else
                {
                        return;
                }
        }

        // --------------------------------------------------------------------

        // Isset Test. Typically this rule will only apply to checkboxes.
        if (is_null($postdata) AND $callback == FALSE)
        {
                if (in_array('isset', $rules, TRUE) OR in_array('required', $rules))
                {
                        // Set the message type
                        $type = (in_array('required', $rules)) ? 'required' : 'isset';

                        if ( ! isset($this->_error_messages[$type]))
                        {
                                if (FALSE === ($line = $this->CI->lang->line($type)))
                                {
                                        $line = 'The field was not set';
                                }
                        }
                        else
                        {
                                $line = $this->_error_messages[$type];
                        }

                        // Build the error message
                        $message = sprintf($line, $this->_translate_fieldname($row['label']));

                        // Save the error message
                        $this->_field_data[$row['field']]['error'] = $message;

                        if ( ! isset($this->_error_array[$row['field']]))
                        {
                                $this->_error_array[$row['field']] = $message;
                        }
                }

                return;
        }

        // --------------------------------------------------------------------

        // Cycle through each rule and run it
        foreach ($rules As $rule)
        {
            $_in_array = FALSE;

            // We set the $postdata variable with the current data in our master array so that
            // each cycle of the loop is dealing with the processed data from the last cycle
            if ($row['is_array'] == TRUE AND is_array($this->_field_data[$row['field']]['postdata']))
            {
                    // We shouldn't need this safety, but just in case there isn't an array index
                    // associated with this cycle we'll bail out
                    if ( ! isset($this->_field_data[$row['field']]['postdata'][$cycles]))
                    {
                            continue;
                    }

                    $postdata = $this->_field_data[$row['field']]['postdata'][$cycles];
                    $_in_array = TRUE;
            }
            else
            {
                    $postdata = $this->_field_data[$row['field']]['postdata'];
            }

            // --------------------------------------------------------------------

            // Is the rule a callback?
            $callback = FALSE;
            if (substr($rule, 0, 9) == 'callback_')
            {
                    $rule = substr($rule, 9);
                    $callback = TRUE;
            }

            // Strip the parameter (if exists) from the rule
            // Rules can contain a parameter: max_length[5]
            $param = FALSE;
            if (preg_match("/(.*?)\[(.*)\]/", $rule, $match))
            {
                    $rule	= $match[1];
                    $param	= $match[2];
            }

            // Call the function that corresponds to the rule
            if ($callback === TRUE)
            {



                // THIS PART HAVE BEEN MODIFIED **************
                // --------------------------------------------------------------------

                $result;
                $callbackObj = $this->_callbackObj;     // assign default

                // Handle parameters if any
                if ($param)
                {
                    // split settings by ','
                    $settings = explode(',', $param);

                    // Find out if there is any supported params
                    foreach ($settings as $setting)
                    {
                        $setting = trim($setting);

                        // Automatically set the error message if defined
                        $msg = $this->get_setting_value($setting, 'message');
                        if ($msg)
                        {
                            $this->set_message($rule, $msg);
                            continue;
                        }

                        // Automatically use the model if defined
                        $model = $this->get_setting_value($setting, 'model');
                        if ($model)
                        {
                            $modelname = $this->get_modelname($model);

                            if (!isset($this->CI->{$modelname}))
                            {
                                // Load if not already loaded
                                $this->CI->load->model($model);
                            }

                            $callbackObj = $this->CI->{$modelname};

                            continue;
                        }
                        
                        // library ?
                        // more ... ?
                    }                    
                }

                if ($callbackObj == null)
                {
                    // If set to null call global function
                    if (!function_exists($rule))
                        $result = FALSE;    //continue; do not allow to continue if not found
                    else
                        $result = $rule($postdata, $param);
                }
                else
                {                   
                    // If not null call function on object
                    if (!method_exists($callbackObj, $rule))
                        $result = FALSE;    // continue; do not allow to continue if not found
                    else
                        $result = $callbackObj->$rule($postdata, $param);
                }


                
                // ORIGINAL CODE ***********
                // --------------------------------------------------------------------
                
                /*
                if ( ! method_exists($this->CI, $rule))
                {
                        continue;
                }

                // Run the function and grab the result
                $result = $this->CI->$rule($postdata, $param);
                */

               // --------------------------------------------------------------------

                
                
                // Re-assign the result to the master data array
                if ($_in_array == TRUE)
                {
                        $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                }
                else
                {
                        $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                }

                // If the field isn't required and we just processed a callback we'll move on...
                if ( ! in_array('required', $rules, TRUE) AND $result !== FALSE)
                {
                        continue;
                }
            }
            else
            {
                    if ( ! method_exists($this, $rule))
                    {
                            // If our own wrapper function doesn't exist we see if a native PHP function does.
                            // Users can use any native PHP function call that has one param.
                            if (function_exists($rule))
                            {
                                    $result = $rule($postdata);

                                    if ($_in_array == TRUE)
                                    {
                                            $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                                    }
                                    else
                                    {
                                            $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                                    }
                            }

                            continue;
                    }

                    $result = $this->$rule($postdata, $param);

                    if ($_in_array == TRUE)
                    {
                            $this->_field_data[$row['field']]['postdata'][$cycles] = (is_bool($result)) ? $postdata : $result;
                    }
                    else
                    {
                            $this->_field_data[$row['field']]['postdata'] = (is_bool($result)) ? $postdata : $result;
                    }
            }

            // Did the rule test negatively?  If so, grab the error.
            if ($result === FALSE)
            {
                    if ( ! isset($this->_error_messages[$rule]))
                    {
                            if (FALSE === ($line = $this->CI->lang->line($rule)))
                            {
                                    $line = 'Unable to access an error message corresponding to your field name.';
                            }
                    }
                    else
                    {
                            $line = $this->_error_messages[$rule];
                    }

                    // Is the parameter we are inserting into the error message the name
                    // of another field?  If so we need to grab its "field label"
                    if (isset($this->_field_data[$param]) AND isset($this->_field_data[$param]['label']))
                    {
                            $param = $this->_translate_fieldname($this->_field_data[$param]['label']);
                    }

                    // Build the error message
                    $message = sprintf($line, $this->_translate_fieldname($row['label']), $param);

                    // Save the error message
                    $this->_field_data[$row['field']]['error'] = $message;

                    if ( ! isset($this->_error_array[$row['field']]))
                    {
                            $this->_error_array[$row['field']] = $message;
                    }

                    return;
            }
        }
    }
}

?>
