<?php

class User_Model extends CI_Model 
{
    const TABLE = 'users';

    public function checkUser($data = array())
    {
        $this->db->select('id');
        $this->db->from(self::TABLE);
        $this->db->where(array('oauth_provider' => $data['oauth_provider'], 'oauth_uid' => $data['oauth_uid']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if ($prevCheck > 0) {
            $prevResult = $prevQuery->row_array();
            $update = $this->db->update(self::TABLE, $data, array('id' => $prevResult['id']));
            $userID = $prevResult['id'];
        } else {
            $insert = $this->db->insert(self::TABLE, $data);
            $userID = $this->db->insert_id();
        }

        return $userID ? $userID : FALSE;
    }

    public function total($param_where = NULL) 
    {
        $this->db->from(self::TABLE);

        if (isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->count_all_results();
    }

    public function get($param_where = NULL) 
    {
        $this->db->select('*')->from(self::TABLE);

        if (isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->get()->row_array();
    }

    public function update($param_data = NULL, $param_where = NULL) 
    {            
        $this->db->where($param_where);
        $this->db->update(self::TABLE, $param_data);  
        $fag = $this->db->affected_rows();

        if ($fag > 0) {
            return array(
                'type' => 'seccessful',
                'message' => lang('update_seccessful'),
            );
        } else {
            return array(
                'type' => 'error',
                'message' => lang('update_error'),
            );
        }
    }
}
