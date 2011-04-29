<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();

        // Make sure user is authorized - all actions
        ensure_authenticated();
    }

    public function index()
    {
        $this->template->load('settings/index');
    }


    // Not used anywhere yet
    public function deleteimage()
    {
        // check that user hasimage / or folder even exists ?

        // Delete folder
        // rmdir

        // Update user in database
        $this->load->model('ProfileUserModel','model');
        $this->model->update_profile_image_status(get_user()->get_id(), FALSE);

        // check if ok ? or just assume it

        // update logged in user

        // show status message
        // redirect ....
    }



    // Links på search til profile ...
    // Links på search by interest ?
    
    // Korrekte billede helpers over det hele

    // Add friend under profile ?


    // RYDT OP ... SLET COMMENTS ...

    


    public function uploadimage()
    {
        $viewdata = array();

        if ($_POST)
        {
            $this->load->library('upload/UploadService');

            // Try to Recieve the image
            if ($this->uploadservice->recieve_profile_image_upload(get_user()->get_id()))
            {
                // Success




                
                //could inject the imageservice into the upload service ? but then i should be using the loader!? or pass arguments ? or create default constructor


                
                // Create images                                                MOVE TO THE UPLOAD SERVICE ?
                $this->load->library('image/ImageService');
                $this->imageservice->generate_profile_image($this->uploadservice->get_upload_data());



                        
                        // Check for return ??? true false ? ikke fejl ? ved fejl skal den jo ikke opdaterer db men istedet sætte til FALSE ? for brugeren
                        // Bare gem boolean og send med til update ...





                // Update user if not already having an image
                $user = get_user();
                if (!$user->has_image())
                {
                    // Update user in database
                    $this->load->model('ProfileUserModel','model');
                    $this->model->update_profile_image_status(get_user()->get_id(), TRUE);    // insert_picture_url(get_user()->get_id(), $data['upload_data']['file_name']);

                    // Update user object
                    $user->set_has_image(TRUE);
                    $this->authenticationservice->login($user);
                }

                // Show confirmation
                set_status_message('Your image have been uploaded');



                
                //return redirect(profile_route());
            }

            // Fail

            // Show error message about what went wrong...
            // use status message or display some form like error in red ?

            set_status_message('Something went wrong with your upload', $viewdata);

            $viewdata["errors"] = $this->uploadservice->get_errors();       // use for something in view ? add to viewdata  use form_validation add error og helpers til fejl ?
        }

        // Fallback
        $this->template->load('settings/uploadimage', $viewdata);
    }

    public function edit($id = "")
    {
        // Should work with is_admin -> should be allowed to change settings for everyone
        
        if($_POST)
        {
            //Post request

            // Set delimiters - hide this away (extend controller etc...)
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            //validate form
            if ($this->form_validation->run('updateprofile'))
            {
                //get the values from the form
                $id = $this->input->post('id');
                $email = $this->input->post('email');
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $city = $this->input->post('city');
                $zip = $this->input->post('zip');
                $country = $this->input->post('country');
                
                //updates the user
                $this->load->model('user/UserModel', 'UserModel');
                $this->UserModel->update($email, array(
                    //it fucks up if one tries to edit email
                    //why ??
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'city' => $city,
                    'zip' => $zip,
                    'country' => $country
            ));

            //success confirm message to user
            set_status_message('Your changes have been saved');

            //redirects
            return redirect(settings_route());
            }

        }
        //Set userid
        $userid = get_user()->get_id();

        //check if id is sent with request and set userid
        if( $id != "")
        {
            $userid = $id;
        }

        // Get authenticated user by email
        $this->load->model('user/UserModel', 'UserModel');
        $viewdata['user'] = $this->UserModel->get_by_id($userid);

        // default fallback
        $this->template->load('settings/edit', $viewdata);
    }
}

?>