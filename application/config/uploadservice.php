<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(

    'profile_image' => array(
        'upload_path'   => './content/img/',
        'allowed_types' => 'gif|jpg|png',
        'file_name'     => 'original.jpg',   // aner jo ikke om det er jpg der bliver uploadet ?
        'overwrite'     => TRUE,
        'max_size'      => 2048,
    )
);

?>