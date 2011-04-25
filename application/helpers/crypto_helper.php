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

function generate_randomcode()
{
    // length ? define as parameter? or indicate in name ?
    // length is fine but check it is not longer than maximum length ? 32 ? 44 / 43 ?

    $CI =& get_instance();
    $CI->load->helper('string');
    
    //return random_string('unique');
    return random_string('encrypt');
}

?>