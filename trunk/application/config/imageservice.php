<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
    "profile" => array(
            //'source_image' => $image_data['full_path'],     // hvor ? skal injectes ?
            'new_image' => 'profile.jpg',
            //'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            //'master_dim' => 'auto',
            'width' => 180,
            //'height' => 200,
            //'quality' => '90'
        ),
    "thumbnail" => array(
            //'source_image' => $image_data['full_path'],
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
