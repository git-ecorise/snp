<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generate_salt()
{
    $CI =& get_instance();
    $CI->load->helper('string');

    return random_string('encrypt');
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

function generate_randomcode($length = 32)
{
    $CI =& get_instance();
    $CI->load->helper('string');
    
    //$code = random_string('unique');
    $code = random_string('encrypt');

    return substr($code, 0, $length);
}

?>