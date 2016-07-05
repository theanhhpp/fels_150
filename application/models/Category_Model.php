<?php

class Category_Model extends CI_Model 
{   
    const TABLE = 'categories';

    public function get($param_where) 
    {
        return $this->db->select('*')->from(self::TABLE)->where($param_where)->get()->row_array();
    }
    
    public function create($data_value = NULL) 
    {
        $this->db->insert(self::TABLE, $data_value);
        return $this->db->affected_rows();
    }

    public function view_category($start, $limit) 
    {
        return $this->db->select('*')->from(self::TABLE)->order_by('id DESC')->limit($limit, $start)->get()->result_array();
    }

    public function total() 
    {
        return $this->db->from(self::TABLE)->count_all_results();
    }
}
