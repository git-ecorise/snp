<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Shared rules
$emailRule = 'trim|required|valid_email';
$passwordRule = 'required|min_length[5]';
$nameRule = 'trim|required|min_length[3]|alpha_dash';
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
                                        'rules' => 'required|matches[password]'
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