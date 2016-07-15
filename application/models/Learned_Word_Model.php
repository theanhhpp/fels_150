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

    public function word_same_date($id)
    {
        return $this->db->select('COUNT(' .self::TABLE. '.user_id) AS number_word, DATE(' .self::TABLE. '.created_at) AS time, words.category_id')
            ->from(self::TABLE)
            ->join('words', self::TABLE . '.word_id = words.id')
            ->where(self::TABLE . '.user_id' , $id)
            ->group_by('time')
            ->order_by(self::TABLE . '.created_at DESC')
            ->get()->result_array();
    }
}
