<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller
{
   public function  __construct()
    {
        parent::__construct();

        // Ensure user is authorized - all actions
        ensure_authenticated();
    }


    // Links
    // Add comment skal return til rigtige urls (hvis man er under en profil går den til sig selv)

    // Vis ikke sig selv i blandt friends
    

    public function index($id = "")
    {
        //load models
        $this->load->model('StatusModel');
        $this->load->model('InterestUserModel');
        $this->load->model('ProfileUserModel');
        $this->load->model('user/UserModel');

        //Set userid
        $userid = get_user()->get_id();

        //check if id is sent with request and set userid
        // Are you on your own profile page or on someone elses ...
        if($id != "" && $id != $userid)
        {
            // Visiting someone else - only show their status updates
            
            $userid = $id;
            $updates = $this->ProfileUserModel->get_all_updates($userid);
            $comments = array();

            foreach ($updates as $update)
            {
                // Create o(n) query - bad performance
                $comments[$update->id] = $this->ProfileUserModel->get_all_comments($update->id);
            }

            $data['updates'] = $updates;
            $data['comments'] = $comments;
        }
        else
        {
            // Your own "wall" - see your own statuses and all your friends mixed
            
            $updates = $this->ProfileUserModel->get_all_updates_including_friends($userid);
            $comments = array();

            foreach ($updates as $update)
            {
                // Create o(n) query - bad performance
                $comments[$update->id] = $this->ProfileUserModel->get_all_comments($update->id);
            }

            $data['updates'] = $updates;
            $data['comments'] = $comments;
        }


        $this->load->helper('date');


        
        //get the user
        $data['user'] = $this->UserModel->get_by_id($userid);
        //get the users interests
        $data['interests'] = $this->InterestUserModel->user_interests_toString($userid);
        //get users friends
        $data['friends'] = $this->ProfileUserModel->get_all_user_friends($userid);

        //load profile view
        $this->template->load('profile/index', $data);
    }

    public function update_status()
    {
        $status_update = $this->input->post('statusupdate');

        $this->load->model('StatusModel');

        $this->StatusModel->create($status_update, get_user()->get_id());
        $data['updates'] = $this->StatusModel->get_all();

        return redirect(profile_route());
    }

    public function add_comment()
    {
        //get the post data
        $comment = $this->input->post('comment');
        $status_id = $this->input->post('status_id');
        $userid = $this->input->post('user_id');

        //load the model
        $this->load->model('StatusModel');

        //add comment to statusUpdate
        $this->StatusModel->add_comment($comment, $status_id);

        //return to the profile page
        return redirect(profile_route($userid));
    }
}

?>