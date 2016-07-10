<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends My_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->check_authentication();
        $this->check_action('category', $this->router->fetch_method());
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
            $data['list_category'] = $this->Category_Model->view_category(($page * $config['per_page']), $config['per_page']);
        }   
        $data['title'] = lang('meta_title');
        $data['active'] = "category";
        $data['template'] = $this->template('category/index', 'user/category'); 
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
                $fag = $this->fag_messge($fag, 0, lang('category_create_successful'), lang('category_create_error'));
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
        $this->check_data($data['category'], 'categories');

        if ($this->input->post('edit_category')) {
            $this->set_rules();

            if ($this->form_validation->run()) {
                $array = ['name' => $this->input->post('name')];
                $fag = $this->Category_Model->update($id, $array);
                $fag = $this->fag_messge($fag, 0, lang('category_edit_successful'), lang('category_edit_error'));
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
        $this->check_data($data['category'], 'categories');
        $fag = $this->Category_Model->delete((array)$id);
        $fag = $this->fag_messge($fag, 0, lang('category_delete_successful'), lang('category_delete_error'));
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
