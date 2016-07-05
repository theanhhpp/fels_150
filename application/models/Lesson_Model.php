<?php
class Lesson_Model extends CI_Model 
{
    const TABLE = 'lessons';

    public function get($param_data) 
    {
        return $this->db->select('*')->from(self::TABLE)->where($param_data)->get()->row_array();
    }

    public function total() 
    {
        return $this->db->from(self::TABLE)->count_all_results();
    }
    
    public function view($start, $limit) 
    {
        return $this->db->select(self::TABLE.'.id as lesson_id ,' .self::TABLE. '.name as lesson_name , category_id, 
            categories.name as category_name, '. self::TABLE. '.created_at,' .self::TABLE. '.updated_at')
            ->from(self::TABLE)->join('categories', self::TABLE. '.category_id = categories.id')
            ->order_by(self::TABLE. '.id DESC')
            ->limit($limit, $start)
            ->get()->result_array();  
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
