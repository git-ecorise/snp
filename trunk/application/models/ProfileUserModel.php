<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfileUserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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

    public function get_all_user_friends($user_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('userid',$user_id);
        $this->db->join('userfriends','users.id = userfriends.friendid','left');
        $query = $this->db->get();

        return $query->result();
    }

    public function is_friend($user_id, $friend_id)
    {
        $query = $this->db->get_where('userfriends', array('userid' => $user_id, 'friendid' => $friend_id));

        return $query->num_rows > 0;
    }

    public function has_image($id)
    {
        $this->db->select('hasimage');
        $query = $this->db->get_where('users', array('id'=>$id));
        $result = $query->row();
        return $result->hasimage;
    }
}

?>