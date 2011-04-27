<?php

class StatusModel extends CI_Model {
    function  __construct() {
        parent::__construct();
    }

    public function get_all()
    {
        $query = $this->db->get('statusupdates');

        $users = array();

        foreach ($query->result() as $row)
        {
            $this->load->helper('misc_helper');
            //check if it is a friend
            if(is_friend($row->userid))
                array_push($users, $this->prep_status($row));
        }

        return $users;
    }

    public function prep_status($status)
    {
        //find user from userid
        $this->load->model('UserModel');
        $user = $this->UserModel->get_by_id($status->userid);

        //create the status object
        $status_object = array(
            'status' => $status,
            'user' => $user,
            'comemnts' => "" //TODO
        );

        return $status_object;
    }

    public function get_status_comments($status_id)
    {
        
    }

    public function get_status($user_id)
    {
        
    }

    public function get_all_for_user($id)
    {
        
    }

    public function create($status_update, $user_id)
    {
        //create date
        $tUnixTime = time();
        $sGMTMySqlString = gmdate("Y-m-d H:i:s", $tUnixTime);
        
        $data = array(
            'userid' => $user_id,
            'comment' => $status_update,
            'date' => $sGMTMySqlString
        );
        $this->db->insert('statusupdates', $data);
    }

    public function delete($status_id)
    {
        
    }

    public function add_comment()
    {
        
    }

    public function delete_comment()
    {
        
    }
}
?>
