<?php

class Word_Answer_Model extends CI_Model 
{
    const TABLE = 'word_answers';

    public function get_answer($param_where = NULL) 
    {
        $this->db->select('*')->from(self::TABLE);

        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->get()->result_array();
    }

    public function get_answer_id($param_where = NULL) 
    {
        $this->db->select('*')->from(self::TABLE);

        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        $list_word_answer = $this->db->get()->result_array();

        foreach ($list_word_answer as $key => $value) {
            $array_id[] = $value['id'];
        }
        return $array_id;
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

    public function delete($param_data = NULL) 
    {            
        $this->db->where_in('id', $param_data)->delete(self::TABLE); 
        return $this->db->affected_rows();
    } 
}
