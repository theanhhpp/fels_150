<?php

class Category_Model extends CI_Model 
{   
    const TABLE = 'categories';

    public function get_category_id($param_where) 
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

    public function update($id, $data_value = NULL) 
    {            
        $id = (int)$id;
        $this->db->where('id', $id);
        $this->db->update(self::TABLE, $data_value);
        return $this->db->affected_rows();
    }

    public function delete($checkbox = NULL) 
    {            
        $this->db->where_in('id', $checkbox)->delete(self::TABLE); 
        return $this->db->affected_rows();
    } 

    public function total() 
    {
        return $this->db->from(self::TABLE)->count_all_results();
    }
}
