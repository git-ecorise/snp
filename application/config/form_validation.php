<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// xss_clean and esccape

// Shared rules
$emailRule = 'trim|required|valid_email';                   // min/max length ?
$passwordRule = 'required|min_length[5]';                   // min/max length ?
$nameRule = 'trim|required|min_length[3]|alpha_dash';       // min/max length ?
$validationcodeRule = 'trim|required';
$fullnameRule = 'trim|required|min_length[3]';

$config = array(
             'signup' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $emailRule . '|callback_is_email_available'
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $passwordRule
                                     ),
                                array(
                                        'field' => 'passwordconfirm',
                                        'label' => 'Password Confirmation',
                                        'rules' => 'matches[password]'
                                     ),
                                array(
                                        'field' => 'firstname',
                                        'label' => 'Firstname',
                                        'rules' => $nameRule
                                     ),
                                array(
                                        'field' => 'lastname',
                                        'label' => 'Lastname',
                                        'rules' => $nameRule
                                     )
                                ),
    
             'login' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $emailRule
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $passwordRule
                                     )
                                ),
             'search' => array(
                                array(
                                        'field' => 'name',
                                        'label' => 'Name',
                                        'rules' => $fullnameRule
                                     )
                                ),

             'validate' => array(
                                array(
                                        'field' => 'validationcode',
                                        'label' => 'Validation Code',
                                        'rules' => $validationcodeRule
                                     )

                                )
            );

?>