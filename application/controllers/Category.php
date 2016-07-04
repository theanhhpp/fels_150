<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends My_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('category', 'fels');
    }

    public function add_category() 
    {
        if ($this->input->post('create-category')) {
            $this->form_validation->set_rules('name', lang('category_name'), 'required');      
            $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');

            if ($this->form_validation->run()) {
                $array = array(
                    'name' => $this->input->post('name'),
                );
                $fag = $this->Category_Model->create($array);
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('categories');   
                
                if ($fag > 0) {
                    $fag = array(
                        'type' => 'seccessful',
                        'message' => lang('category_create_successful'),
                    );
                } else {
                    $fag = array(
                        'type' => 'error',
                        'message' => lang('category_create_error'),
                    );
                }  
            }
        }
        $data['title'] = lang('title_create_category');   
        $data['template'] = 'category/create_category';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function index($page = 1) 
    {
        $total = $this->Category_Model->total();
        $config = $this->my_paginationlib->_Pagination("category/index", $total);
        $this->pagination->initialize($config); 
        $data['list_pagination'] = $this->pagination->create_links();
        $total_page = ceil($config['total_rows'] / $config['per_page']); 
        $page = ($page > $total_page) ? $total_page : $page ;
        $page = ($page < 1) ? 1 : $page ;
        $page = $page - 1;

        if ($config['per_page'] > 0) {
            $data['list_category'] = $fag = $this->Category_Model->view_category(($page * $config['per_page']), $config['per_page']);
        }   
        $data['meta_title'] = lang('meta_title');
        $data['active'] = "category";
        $data['template'] = 'category/index';
        $this->load->view('layout/index', $data);
    }
}
