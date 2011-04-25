<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Misc helper vs Controller helper ?

// Could create abstract base implementation of the controller and add the method there instead
// makes more sense to make it available to all controllers - just like it will be needed to check if it is ajax request in the future (there is a helper for that in CI??? - somewhere)
// even thought all controllers might not want to use the same layout ?

// Or just easier to keep in helpers ?

function is_post()
{
    $CI =& get_instance();
    return $CI->input->server('REQUEST_METHOD') === 'POST';
}

function set_status_message($message, Array $arr = null)
{
    // Better name ?
    // Better Implementation ?
   
    $statuskey = 'Status';

    if ($arr == null)
    {
        // Use session flashdata

        $CI =& get_instance();
        $this->session->set_flashdata($statuskey, $message);
    }
    else
    {
        // set the array
        
        $arr[$statuskey] = $message;
    }
}








    function is_email_available123($email)
    {
        // Move the logic to function somewhere ...
        // Put callback somewhere else ? base controller - core ?


        $CI =& get_instance();


        // Set callback error message (could be set elsewhere - in cofig file)
        $CI->form_validation->set_message('is_email_available', 'The %s is already signed up.');

        // Check if email exists - Could use more optimal query
        $CI->load->model('db/UserModel');
        return $CI->UserModel->get_by_email($email) == null;
    }






?>