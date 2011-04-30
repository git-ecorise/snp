<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfileUserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_all_updates($userid)
    {
        $this->db->select("statusupdates.*, users.hasimage, users.firstname, users.lastname");
        $this->db->from("statusupdates");
        $this->db->join('users', 'statusupdates.userid = users.id', "INNER");
        $this->db->order_by("statusupdates.date", "DESC");
        $this->db->where("statusupdates.userid", $userid);
        
        $this->db->limit(10);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_comments($updateid)
    {
        $this->db->select("comments.*, users.hasimage, users.firstname, users.lastname");
        $this->db->from("comments");
        $this->db->join('users', 'comments.userid = users.id', "INNER");
        $this->db->order_by("comments.date", "ASC");
        $this->db->where("comments.wallid", $updateid);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_updates_including_friends($userid)
    {
        $this->db->select("statusupdates.*, users.hasimage, users.firstname, users.lastname");
        $this->db->from("statusupdates");
        $this->db->join('users', 'statusupdates.userid = users.id', "INNER");
        $this->db->order_by("statusupdates.date", "DESC");
        $this->db->where("statusupdates.userid", $userid);
        $this->db->or_where("statusupdates.userid IN (SELECT userfriends.friendid FROM userfriends WHERE userfriends.userid = " .$userid .")");

        $this->db->limit(10);

        $query = $this->db->get();

        return $query->result();       
    }




    public function update_profile_image_status($id, $hasimage)
    {
        $this->db->where('id', $id);
        $this->db->update('users', array('hasimage' => $hasimage));

        return $this->db->affected_rows() > 0;
    }

    public function add_friend($id, $user_id)
    {
        //add friend to users list of friends
        $data = array(
            'userid' => $user_id,
            'friendid' => $id
            );

        $this->db->insert('userfriends', $data);
    }

    public function get_all_user_friends($userid)
    {
        $this->db->select('users.id, users.hasimage, users.firstname, users.lastname, userfriends.userid, userfriends.friendid');
        $this->db->from('userfriends');
        $this->db->join('users','userfriends.friendid = users.id','inner');

        $this->db->where('userfriends.userid', $userid);
        //$this->db->where('userfriends.friendid !=', get_user()->get_id());    // dont include yourself ?

        $query = $this->db->get();

        return $query->result();
    }

    public function is_friend($user_id, $friend_id)
    {
        $query = $this->db->get_where('userfriends', array('userid' => $user_id, 'friendid' => $friend_id));

        return $query->num_rows > 0;
    }



    // Hopefully not used...
    public function has_image($id)
    {
        $this->db->select('hasimage');
        $query = $this->db->get_where('users', array('id'=>$id));
        $result = $query->row();
        return $result->hasimage;
    }
}

?>