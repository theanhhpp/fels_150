<?php

class Category_Model extends CI_Model 
{   
    const TABLE = 'categories';

    public function get($id = 0) 
    {
        $id = (int)$id;
        return $this->db->select('*')->from(self::TABLE)->where(array('id' => $id))->get()->row_array();
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
