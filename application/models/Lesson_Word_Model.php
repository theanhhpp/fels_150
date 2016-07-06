<?php

class Lesson_Word_Model extends CI_Model 
{
    const TABLE = 'lesson_words';

    public function get($param_data) 
    {
        return $this->db->select('*')->from(self::TABLE)->where($param_data)->get()->result_array();
    }

    public function total() 
    {
        return $this->db->from(self::TABLE)->count_all_results();
    }
    
    public function view($start, $limit) 
    {
        return $this->db->select('*')->from(self::TABLE)->order_by(self::TABLE. '.id DESC')->limit($limit, $start)->get()->result_array();  
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

    public function delete($id) 
    {            
        $this->db->where('id', $id)->delete(self::TABLE); 
        return $this->db->affected_rows();
    } 
}
