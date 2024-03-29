<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generate_salt()
{
    $CI =& get_instance();
    $CI->load->helper('string');

    return substr(random_string('encrypt'), 20);
}

function generate_hash($str, $salt = '')
{
    $str = $salt . $str;
    return hash('sha256', $str);
}

function verify_hash($hash, $str, $salt = '')
{
    $newhash = generate_hash($str, $salt);
    return $hash === $newhash;
}

function generate_randomcode($length = 20)
{
    $CI =& get_instance();
    $CI->load->helper('string');
 
    $code = random_string('encrypt');

    return substr($code, 0, $length);
}

?>