<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function is_post()
{
    return $this->input->server('REQUEST_METHOD') === 'POST';
}

?>