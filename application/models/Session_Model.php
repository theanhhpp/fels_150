<?php

class Session_Model extends CI_Model 
{
    const TABLE = 'users';
    
    public function __construct() 
    {
        parent::__construct();     
    }

    public function create($param_data = NULL) 
    {
        $this->db->insert(self::TABLE, $param_data);
        return $this->db->affected_rows();
    } 
}
