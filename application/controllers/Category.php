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
		$config = $this->_pagination();		
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

	public function _pagination() 
	{
		$config['full_tag_open'] = '<ul class="pagination" style ="margin: 0 0;">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '&laquo First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last &raquo';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</li></a>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE;
		$config['base_url'] = 'http://localhost/fels_150/index.php/category/index';
		$config['total_rows'] = $this->Category_Model->total();
		$config['per_page'] = 5;
		return $config;			
	}
}
