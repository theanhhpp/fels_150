<?php

class Relationship_Model extends CI_Model 
{
    const TABLE = 'relationships';

    public function follow($current_user_id, $other_user_id) 
    {
        $current_user_id = (int) $current_user_id;
        $other_user_id = (int) $other_user_id;
        $this->db->select('*')->from(self::TABLE)->where(['follower_id' => $current_user_id, 'followed_id' => $other_user_id ]);
        $count = $this->db->count_all_results();

        if ($count == 0) {
            $this->db->insert(self::TABLE, ['follower_id' => $current_user_id, 'followed_id' => $other_user_id]);
            $this->db->affected_rows();
        }
    }

    public function unfollow($current_user_id, $other_user_id) 
    {            
        $current_user_id = (int) $current_user_id;
        $other_user_id = (int) $other_user_id;
        $this->db->delete(self::TABLE, ['follower_id' => $current_user_id, 'followed_id' => $other_user_id]); 
        $this->db->affected_rows();
    }

    public function is_following($current_user_id, $other_user_id) 
    {            
        $current_user_id = (int) $current_user_id;
        $other_user_id = (int) $other_user_id;
        $array =$this->db->select('followed_id')->from(self::TABLE)->where(['follower_id' =>$current_user_id])->get()->result_array(); 
        
        if (isset($array) && count($array)) {
            foreach ($array as $key => $value) {
                $temp[] = $value['followed_id'];
            }     
            if (in_array ($other_user_id,  $temp)) {
                return TRUE;
            } else {
                return FALSE;
            }    
        }        
        return FALSE;
    }
    
    public function count_followings($user_id) 
    {            
        $user_id = (int) $user_id;
        return $this->db->select('followed_id')->from(self::TABLE)->where(['follower_id' =>$user_id])->count_all_results();
    }

    public function count_followers($user_id) 
    {            
        $user_id = (int) $user_id;
        return $this->db->select('follower_id')->from(self::TABLE)->where(['followed_id' => $user_id])->count_all_results();
    }

    public function followings($user_id, $start = 0, $limit = 0) 
    {            
        $user_id = (int) $user_id;
        $array = $this->db->select('followed_id')->from(self::TABLE)->where(['follower_id' => $user_id])
            ->limit($limit, $start)->get()->result_array();
        if (isset($array) && count($array)) {
            foreach ($array as $key => $value) {
                $temp[] = $this->User_Model->get(['id'=> $value['followed_id']]); 
            }
            return $temp;      
        }
        return NULL;
    }

    public function followers($user_id, $start = 0, $limit = 0) 
    {            
        $user_id = (int) $user_id;
        $array = $this->db->select('follower_id')->from(self::TABLE)->where(['followed_id' => $user_id])
            ->limit($limit, $start)->get()->result_array();

        if (isset($array) && count($array)) {
            foreach ($array as $key => $value) {
                $temp[] = $this->User_Model->get(['id'=> $value['follower_id']]); 
            }
            return $temp;      
        }
        return NULL;
    }
}
