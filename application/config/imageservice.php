<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    "profile" => array(
            'new_image' => 'profile.jpg',
            //'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 180,
            'height' => 300,
            'master_dim' => 'width',
            //'quality' => '90'
        ),
    "thumbnail" => array(
            'new_image' => 'thumbnail.jpg',
            //'create_thumb' => TRUE,
            //'maintain_ratio' => TRUE,
            //'master_dim' => 'auto',
            'width' => 30,
            'height' => 30,
            //'quality' => '90'
        )
);

?>
