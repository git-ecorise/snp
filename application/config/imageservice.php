<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    "profile" => array(
            'new_image' => 'profile.jpg',
            'maintain_ratio' => TRUE,
            'width' => 180,
            'height' => 300,
            'master_dim' => 'width',
            //'quality' => '90'
        ),
    "thumbnail" => array(
            'new_image' => 'thumbnail.jpg',
            'maintain_ratio' => FALSE,
            'width' => 40,
            'height' => 40,
            'master_dim' => 'auto',
            //'quality' => '90'
        )
);

?>
