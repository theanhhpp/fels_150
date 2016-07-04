<?php

class Word_Model extends CI_Model 
{
    const TABLE = 'words';

    public function get($id =0) 
    {
        $id = (int)$id;
        return $this->db->select('*')->from(self::TABLE)->where(array('id'=> $id))->get()->row_array();
    }

    public function total() 
    {
        return $this->db->from(self::TABLE)->count_all_results();
    }
    
    public function view($start, $limit) 
    {
        return $this->db->select('*')->from(self::TABLE)->order_by('id DESC')->limit($limit, $start)->get()->result_array();   
    }

    public function insert($param_data = NULL) 
    {
        $this->db->insert(self::TABLE, $param_data);
        return $this->db->affected_rows();
    }

    public function update($id, $param_data = NULL) 
    {            
        $id = (int)$id;
        $this->db->where('id', $id);
        $this->db->update(self::TABLE, $param_data);
        return $this->db->affected_rows();
    }

    public function delete($checkbox = NULL) 
    {            
        $this->db->where_in('id', $checkbox)->delete(self::TABLE); 
        return $this->db->affected_rows();
    } 
}
