<?php

class Category_Model extends CI_Model 
{   
    const TABLE = 'categories';

    public function get_category_id($param_where) 
    {
        return $this->db->select('*')
            ->from(self::TABLE)
            ->where($param_where)
            ->get()->row_array();
    }
    
    public function create($data_value = NULL) 
    {
        $this->db->insert(self::TABLE, $data_value);
        return $this->db->affected_rows();
    }

    public function view_category($start, $limit) 
    {
        return $this->db->select('*')
            ->from(self::TABLE)
            ->order_by('id DESC')
            ->limit($limit, $start)
            ->get()->result_array();
    }

    public function show_lesson_of_category($id) 
    {
        return $this->db->select('lessons.id, lessons.name as lesson_name')
            ->from(self::TABLE)
            ->join('lessons', self::TABLE . '.id = lessons.category_id')
            ->where(self::TABLE . '.id' , $id)
            ->order_by(self::TABLE . '.id DESC')
            ->get()->result_array();   
    }

    public function show_word_of_category($id) 
    {
        return $this->db->select('words.id, words.content as word_content')
            ->from(self::TABLE)
            ->join('words', self::TABLE . '.id = words.category_id')
            ->where(self::TABLE . '.id' , $id)
            ->order_by(self::TABLE . '.id DESC')
            ->get()->result_array();   
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
