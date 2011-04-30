<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InterestUserModel extends CI_Model
{
    function  __construct()
    {
        parent::__construct();
    }

    public function search_interests_by_term($term)
    {
        $this->db->like('LOWER(value)', strtolower($term));
        $query = $this->db->get('interests', 10);
        return $query->result_array();
    }

    public function update_interests($interests, $user_id)
    {
        foreach($interests as $interest)
        {
            //remove whitespace
            $interest = trim($interest);

            //check if the interest exist in db
            //if not insert into db
            if(!$this->is_interest($interest))
            {
                //TODO: this is not optimal, but works for now!
                $data = array(
                    'label' => $interest,
                    'value' => $interest
                );

                //insert into db
                $this->db->insert('interests', $data);
            }

            //insert interest for user
            $this->add_interest_to_user($this->get_interest_by_value($interest)->id, $user_id);
        }

        //remove interests that aren't in the new array
        $this->sync_user_interests($user_id, $interests);

    }

    private function sync_user_interests($user_id, $new_interests)
    {
        //gets the existing
        $db_old_interests = $this->get_interest_for_user($user_id);

        foreach ($db_old_interests as $value)
        {
            if(!in_array($value['value'], $new_interests))
            {
                //delete from db
                $this->db->delete('userinterests', array('userid' => $user_id, 'interestid'=> $value['interestsid']));
            }
        }
    }

    public function add_interest_to_user($interest_id, $user_id)
    {
        //check if interest is already added for user
        if(!$this->is_interest_added_for_user($interest_id, $user_id))
        {
            //prepare data for insert
            $data = array(
                'userid' => $user_id,
                'interestid' => $interest_id
            );
            //add interest into db for user
            $this->db->insert('userinterests', $data);
        }
    }

    public function is_interest_added_for_user($interest_id, $user_id)
    {
        return $this->db->get_where('userinterests', array('userid'=>$user_id, 'interestid'=>$interest_id))->num_rows() > 0;
    }

    public function get_interest_by_value($value)
    {
        return $this->db->get_where('interests', array('value'=>$value), 1)->row();
    }

    private function is_interest($term)
    {
        $this->db->where('value', $term);
        return $this->db->get('interests')->num_rows() > 0;
    }

    public function get_interest_for_user($user_id)
    {
        $this->db->select('*');
        $this->db->from('userinterests');
        $this->db->where('userid',$user_id);
        $this->db->join('interests','interests.id = userinterests.interestid','left');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function search_friends_by_interests($terms)
    {
        $common_friends = array();

        $all_users = array();
        
        foreach($terms as $term)
        {
            //get the users that have this interest
            $users = $this->get_users_by_term($term);
            //merge users with the all_user array
            foreach ($users as $key=>$user)
            {
                if($user!=null)
                    $all_users[$key] = $user;
            }  
        }

        return $all_users;
    }

    public function get_users_by_term($term)
    {

        //get the interestobject from db by term
        $interest = $this->get_interest_by_term($term);
        if(isset($interest->id))
        {
            //get all maching userids
            $query = $this->db->get_where('userinterests', array('interestid'=>$interest->id));
            $result = $query->row_array();
            $users = array();
            $this->load->model('user/UserModel');
            //get the users from userids

            foreach ($result as $row)
            {
                $user = $this->UserModel->get_by_id($row['id']);
                $users[$row['id']] = $user;
            }

            //return all the users with this interest
            return $users;
        }
        else
        {
            return array();
        }
    }

    public function get_interest_by_term($term)
    {
        $query = $this->db->get_where('interests', array('LOWER(value)'=> strtolower($term)), 1);
        return $query->row();
    }

    public function user_interests_toString($user_id)
    {
        $db_result = $this->get_interest_for_user($user_id);
        $string = "";

        $length = count($db_result);

        for($i = 0; $i < $length; $i++)
        {
            $string .= $db_result[$i]['value'];

            if ($i < $length-1)
                $string .= ', ';
        }

        return $string;
    }
}

?>