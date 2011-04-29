<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    'profile_image' => array(
        'upload_path'   => './content/img/',
        'allowed_types' => 'gif|jpg|png',
        'file_name'     => 'original.jpg',
        'overwrite'     => TRUE,
        'max_size'      => 2048,
    )
);

?>