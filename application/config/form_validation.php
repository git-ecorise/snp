<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Shared rules
$email_rule = 'trim|required|valid_email';
$password_rule = 'required|min_length[5]';
$name_rule = 'trim|required|alpha_dash';
$fullname_rule = 'trim|required';

$code_rule = 'trim|required';

$nonumbers_rule = 'trim|';                           // hvad menes der ? der er validators for dette ?
$zipcode_rule = 'trim|numeric|max_length[4]|';

$config = array(
             'signup' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $email_rule . '|callback_is_unique_email[model={user/UserModel}, message={The %s is already signed up.}]'
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $password_rule
                                     ),
                                array(
                                        'field' => 'passwordconfirm',
                                        'label' => 'Password Confirmation',
                                        'rules' => 'required|matches[password]'
                                     ),
                                array(
                                        'field' => 'firstname',
                                        'label' => 'Firstname',
                                        'rules' => $name_rule
                                     ),
                                array(
                                        'field' => 'lastname',
                                        'label' => 'Lastname',
                                        'rules' => $name_rule
                                     )
                                ),
    
             'login' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $email_rule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]|callback_email_validated[model={user/UserModel}, message={The %s is not validated.}]"
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $password_rule
                                     )
                                ),

             'validate' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $email_rule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]|callback_email_not_validated[model={user/UserModel}, message={The %s is already validated.}]"
                                     ),
                                array(
                                        'field' => 'validationcode',
                                        'label' => 'Validation Code',
                                        'rules' => $code_rule
                                     )
                                ),

             'resetpassword' => array(
                                    array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $email_rule . "|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]"
                                     )
                                ),

             'changepassword' => array(
                                array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => $email_rule . '|callback_email_exist[model={user/UserModel}, message={The %s does not exist.}]'
                                     ),
                                array(
                                        'field' => 'password',
                                        'label' => 'Password',
                                        'rules' => $password_rule
                                     ),
                                array(
                                        'field' => 'passwordconfirm',
                                        'label' => 'Password Confirmation',
                                        'rules' => 'required|matches[password]'
                                     ),
                                array(
                                        'field' => 'resetcode',
                                        'label' => 'Reset code',
                                        'rules' => $code_rule
                                     )
                                ),

             'search' => array(
                                array(
                                        'field' => 'name',
                                        'label' => 'Name',
                                        'rules' => $fullname_rule
                                     )
                                ),

             'updateprofile' => array(
                                array(
                                        'field' => 'firstname',
                                        'label' => 'Firstname',
                                        'rules' => $name_rule
                                     ),
                                array(
                                        'field' => 'lastname',
                                        'label' => 'Lastname',
                                        'rules' => $name_rule
                                     ),
                                array(
                                        'field' => 'city',
                                        'label' => 'City',
                                        'rules' => $nonumbers_rule
                                     ),
                                array(
                                        'field' => 'country',
                                        'label' => 'Country',
                                        'rules' => $nonumbers_rule
                                     ),
                                array(
                                        'field' => 'zip',
                                        'label' => 'Zip',
                                        'rules' => $zipcode_rule
                                     )
                                     )

            );

?>