<?php

class Learned_Word_Model extends CI_Model 
{
    const TABLE = 'learned_word';

    public function total($param_where) 
    {
        $this->db->from(self::TABLE);
        if(isset($param_where) && count($param_where)) {
            $this->db->where($param_where);
        }
        return $this->db->count_all_results();
    }

    public function insert($param_data = NULL) 
    {
        $this->db->insert(self::TABLE, $param_data);
        $fag = [
            'affected_rows' => $this->db->affected_rows(),
            'insert_id' => $this->db->insert_id(),
        ];
        return $fag;
    }
}
