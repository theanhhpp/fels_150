<?php

class Result_Model extends CI_Model 
{
    const TABLE = 'results';

    public function get($param_where = NULL) {
        $this->db->select('*')->from(self::TABLE);
        
        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->get()->result_array();
    }

    public function total($param_where = NUll) 
    {
        $this->db->from(self::TABLE);
        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->count_all_results();
    }
    
    public function view($start, $limit,$param_where) 
    {
        $this->db->select(self::TABLE. '.id as result_id ,'.self::TABLE. '.result, lessons.name,' .self::TABLE. '.created_at,' .self::TABLE. '.updated_at')
            ->from(self::TABLE)->join('lessons', self::TABLE. ' . lesson_id = lessons.id')
            ->order_by(self::TABLE. '.id DESC')
            ->limit($limit, $start);

        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->get()->result_array();   
    }

    public function insert($param_data = NULL) 
    {
        $this->db->insert(self::TABLE, $param_data);
        $fag = array(
            'affected_rows' => $this->db->affected_rows(),
            'insert_id' => $this->db->insert_id(),
        );
        return $fag;
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
