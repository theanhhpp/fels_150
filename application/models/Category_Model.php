<?php

class Category_Model extends CI_Model 
{   
    const TABLE = 'categories';

    public function __construct() 
    {
        parent::__construct();
    }

    public function create($data_value = NULL) 
    {
        $this->db->insert(self::TABLE, $data_value);
        $fag = $this->db->affected_rows();

        if ($fag > 0) {
            return array(
                'type' => 'seccessful',
                'message' => lang('category_create_successful'),
                );
        } else {
            return array(
                'type' => 'error',
                'message' => lang('category_create_error'),
                );
        }
    }

    public function view_category($start, $limit) {
        return $this->db->select('*')->from(self::TABLE)->order_by('id DESC')->limit($limit,$start)->get()->result_array();    
    }

    function total() {
        return $this->db->from(self::TABLE)->count_all_results();
    }
}
