<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('lesson', 'fels');
        $this->lang->load('word', 'fels');
        $this->lang->load('category', 'fels');
        $this->lang->load('user', 'fels');
        $this->authentication = $this->my_authentication->check();
    }
    
    public function index($page = 1) 
    {
        $data['title'] = lang('name_project');

        if (!isset($this->authentication) && count($this->authentication) == 0) {
            $this->load->view('layout/home_page', $data);
        } else {
            $temp[0] = $this->authentication['id'];
            $array = $this->Relationship_Model->followings($this->authentication['id']);

            if(isset($array) && count($array)) {
                foreach ($array as $key => $value) {
                    $temp[] = $value['id']; 
                }     
            }
            $total_rows = $this->Result_Model->count_result_all($temp);
            $config = $this->my_paginationlib->_Pagination('home/index', $total_rows);  
            $this->pagination->initialize($config); 
            $data['list_pagination'] = $this->pagination->create_links();
            $total_page = ceil($config['total_rows'] / $config['per_page']); //ceil lấy phần nguyên
            $page = ($page > $total_page) ? $total_page : $page ;
            $page = ($page < 1) ? 1 : $page ;
            $page = $page - 1 ;
            if ($config['per_page'] > 0) {
                $data['list_result'] = $this->Result_Model->view_result_all($temp, ($page * $config['per_page']), $config['per_page']);
            }
            $data['template'] = 'layout/static_page';
            $data['authentication'] = $this->authentication;
            $this->load->view('layout/index', $data);
        }
    }
}
