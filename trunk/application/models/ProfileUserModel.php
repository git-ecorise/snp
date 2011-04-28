<?php

/**
 * Description of ProfileUserModel
 *
 * @author BigSlott
 */
class ProfileUserModel extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    public function insert_picture_url($id, $picture_url)
    {
        $this->db->where('id', $id);
        $this->db->update('user', array('pictureurl'=>$picture_url));
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
        $this->db->from('user');
        $this->db->where('userid',$user_id);
        $this->db->join('userfriends','user.id = userfriends.friendid','left');
        $query = $this->db->get();

        return $query->result();
    }

    public function is_friend($user_id, $friend_id)
    {
        $query = $this->db->get_where('userfriends', array('userid' => $user_id, 'friendid' => $friend_id));

        return $query->num_rows > 0;
    }
}
?>
