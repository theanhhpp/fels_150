<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('category', 'fels');
        $this->authentication = $this->my_authentication->check();
    }

    public function add_category() 
    {

        if ($this->input->post('create-category')) {
            $this->form_validation->set_rules('name', lang('category_name'), 'required');      
            $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');

            if ($this->form_validation->run()) {
                $array = array(
                    'name' => $this->input->post('name'),
                    'created_at' => gmdate('Y-m-d H:i:s',time() + 7*3600),
                    );
                $fag = $this->Category_Model->create($array);
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('categories');     
            }
        }
        $data['title'] = lang('title_create_category');   
        $data['template'] = 'category/create_category';
        $this->load->view('layout/index', $data);
    }

    public function index($page = 1) 
    {
        $this->load->library('pagination');
        $this->load->library('paginationlib');
        $config  = $this->paginationlib->_Pagination("category/index",$this->Category_Model->total());
        $this->pagination->initialize($config); 
        $data['list_pagination'] = $this->pagination->create_links();
        $total_page = ceil($config['total_rows']/$config['per_page']); 
        $page = ($page > $total_page)? $total_page : $page ;
        $page = ($page < 1)? 1 : $page ;
        $page = $page-1;

        if ($config['per_page'] > 0) {
            $data['list_category'] =$fag = $this->Category_Model->view_category(($page*$config['per_page']),$config['per_page']);
        }   
        $data['meta_title'] = lang('meta_title');
        $data['active'] = "category";
        $data['template'] = 'category/index';
        $this->load->view('layout/index', $data);
    }
}
