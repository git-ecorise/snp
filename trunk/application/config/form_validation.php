<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Shared rules
$emailRule = 'trim|required|valid_email';
$passwordRule = 'required|min_length[5]';
$nameRule = 'trim|required|alpha_dash';
$validationcodeRule = 'trim|required';
$fullnameRule = 'trim|required';

$nonumbersRule = 'trim|';
$zipRule = 'trim|numeric|max_length[4]|';

$config = array(
             'signup' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $emailRule . '|callback_is_unique_email[model={user/UserModel}, message={The %s is already signed up.}]'
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
                                        'rules' => $emailRule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]|callback_email_validated[model={user/UserModel}, message={The %s is not validated.}]"
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $passwordRule
                                     )
                                ),

             'validate' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $emailRule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]|callback_email_not_validated[model={user/UserModel}, message={The %s is already validated.}]"
                                     ),
                                array(
                                        'field' => 'validationcode',
                                        'label' => 'Validation Code',
                                        'rules' => $validationcodeRule
                                     )
                                ),

             'resetpassword' => array(
                                    array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $emailRule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]"
                                     )
                                ),

             'search' => array(
                                array(
                                        'field' => 'name',
                                        'label' => 'Name',
                                        'rules' => $fullnameRule
                                     )
                                ),

             'updateprofile' => array(
                                array(
                                        'field' => 'firstname',
                                        'label' => 'Firstname',
                                        'rules' => $nameRule
                                     ),
                                array(
                                        'field' => 'lastname',
                                        'label' => 'Lastname',
                                        'rules' => $nameRule
                                     ),
                                array(
                                        'field' => 'city',
                                        'label' => 'City',
                                        'rules' => $nonumbersRule
                                     ),
                                array(
                                        'field' => 'country',
                                        'label' => 'Country',
                                        'rules' => $nonumbersRule
                                     ),
                                array(
                                        'field' => 'zip',
                                        'label' => 'Zip',
                                        'rules' => $zipRule
                                     )
                                     )

            );

?>