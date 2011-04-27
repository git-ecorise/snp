<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Put into Controller (base impl) instead ? or rename to Controller helper ?

function is_post()
{
    $CI =& get_instance();
    return $CI->input->server('REQUEST_METHOD') === 'POST';
}

function set_status_message($message, Array &$arr = null)
{
    if (is_array($arr))
    {
        // set the array
        $arr[STATUS_KEY] = $message;
    }
    else
    {
        // Use session flashdata
        $CI =& get_instance();
        $CI->session->set_flashdata(STATUS_KEY, $message);
    }
}

?>