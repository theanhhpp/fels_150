<?php

class User_Model extends CI_Model 
{
    const TABLE = 'users';

    public function __construct() 
    {
        parent::__construct();
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

    public function update($param_data = NULL,$param_where = NULL) 
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
