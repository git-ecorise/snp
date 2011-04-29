<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StatusModel extends CI_Model
{
    function  __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        $this->db->order_by("date", "desc");
        $query = $this->db->get('statusupdates');

        $users = array();

        foreach ($query->result() as $row)
        {
            $this->load->helper('misc_helper');
            //check if it is a friend
            if(is_friend($row->userid) OR $row->userid == get_user()->get_id())
                array_push($users, $this->prep_status($row));
        }

        return $users;
    }

    public function prep_status($status)
    {
        //find user from userid
        $this->load->model('user/UserModel', 'UserModel');
        $user = $this->UserModel->get_by_id($status->userid);

        //create the status object
        $status_object = array(
            'status' => $status,
            'user' => $user,
            'comments' => $this->get_status_comments($status->id)
        );

        return $status_object;
    }

    public function get_status_comments($status_id)
    {
        $this->db->order_by("date", "asc");
        $query = $this->db->get_where('comments', array('wallid'=>$status_id));
        $comments = $query->result_array();
        foreach ($comments as $key=>$comment)
        {
           //load model
           $this->load->model('user/UserModel');

           $comments[$key]['user'] = $this->UserModel->get_by_id($comment['userid']);
        }
        return $comments;
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

    public function add_comment($comment, $statusid)
    {
        //create date
        $tUnixTime = time();
        $sGMTMySqlString = gmdate("Y-m-d H:i:s", $tUnixTime);

        $data = array(
            'userid' => get_user()->get_id() ,
            'comment' => $comment ,
            'date' => $sGMTMySqlString,
            'wallid' => $statusid
        );

        $this->db->insert('comments', $data);
    }

    public function delete_comment()
    {
        
    }
}
?>
