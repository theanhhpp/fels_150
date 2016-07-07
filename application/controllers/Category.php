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
        $this->authentication = $this->my_authentication->check();
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
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function add() 
    {
        if ($this->input->post('create-category')) {
            $this->set_rules();

            if ($this->form_validation->run()) {
                $array = ['name' => $this->input->post('name')];
                $fag = $this->Category_Model->create($array);  
                $fag = $this->fag_messge($fag, lang('category_create_successful'), lang('category_create_error'));
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('categories');      
            }
        }
        $data['title'] = lang('title_create_category');   
        $data['template'] = 'category/add';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function edit($id = 0) 
    {
        $data['category'] = $this->Category_Model->get_category_id(array('id' => $id));
        $this->check_data($data['category'], 0);

        if ($this->input->post('edit_category')) {
            $this->set_rules();

            if ($this->form_validation->run()) {
                $array = ['name' => $this->input->post('name')];
                $fag = $this->Category_Model->update($id, $array);
                $fag = $this->fag_messge($fag, lang('category_edit_successful'), lang('category_edit_error'));
                $this->session->set_flashdata('message_flashdata', $fag);          
                redirect('categories');
            }
        }
        $data['meta_title'] = lang('title_edit_category');
        $data['template'] = 'category/edit';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        $data['category'] = $this->Category_Model->get_category_id(array('id' => $id));
        $this->check_data($data['category'], 0);
        $fag = $this->Category_Model->delete((array)$id);
        $fag = $this->fag_messge($fag, lang('category_delete_successful'), lang('category_delete_error'));
        $this->session->set_flashdata('message_flashdata', $fag);
        redirect('categories');
    }

    public function show($id = 0)
    {
       $data['category'] = $this->Category_Model->get_category_id(array('id' => $id));
        $data['meta_title'] = lang('title_show_category');
        $data['template'] = 'category/show';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    protected function set_rules()
    {
        $this->form_validation->set_rules('name', lang('category'), 'trim|required' );
        $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');
    }
}
