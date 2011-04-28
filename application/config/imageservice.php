<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// Could hardcode this into the service - or create constants or something like that
// or just expose through get methods

// fleste settings kan sættes i uploads config ... så behøves slet ikke at gøres her

// ellers kan de sendes med ved load af library ... skal bare bruge rigtig definitioner ...

// kan bruge initialize med rigtige configuration ... husk der er forskel på upload og resize af billeder

// lav upload service ?

$config = array(
    'location'  => "./content/img/",
    'formats'   => "gif|jpg|png",
    'thumbnail' => array("width" => 90, "height" => 90),
    'profile'   => array("width" => 200, "height" => 200)
);

?>