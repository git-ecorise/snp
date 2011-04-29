<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

function procesTags($string)
{
    $tags = explode(',', $string);
    $interests = array();
    for ($i = 0; $i < count($tags); $i++)
    {
        $t = trim($tags[$i]);

        if (!empty($t))
        {
            array_push($interests, $t);
        }
    }
    return $interests;
}

function is_friend($friend_id)
{
    $CI =& get_instance();

    $CI->load->model('ProfileUserModel');

    return $CI->ProfileUserModel->is_friend(get_user()->get_id(), $friend_id);
}

function has_image($id)
{
    $CI =& get_instance();

    $CI->load->model('ProfileUserModel');

    return $CI->ProfileUserModel->has_image($id);
}
?>