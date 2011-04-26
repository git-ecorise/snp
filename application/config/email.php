<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = Array(
    'protocol'      => "smtp",
    'smtp_host'     => "ssl://smtp.googlemail.com",
    'smtp_port'     => 465,
    'smtp_timeout'  => "5",
    'smtp_user'     => "socialnetworkp@gmail.com",
    'smtp_pass'     => "Tester1234",

    'mailtype'      => "html",
    'charset'       => "iso-8859-1",
    //'charset'     => 'utf-8',
    'newline'       => "\r\n",      // <-- double qoutes is very important because php really is fucked up!
    'crlf'          => "\r\n",

    'from'          => "socialnetworkp@gmail.com",
    'name'          => "The Social Network"   
);

?>