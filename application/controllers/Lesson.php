<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->lang->load('lesson', 'fels');
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('category', 'fels');
    }

    public function index($page = 1) 
    {
        $this->_action();
        $total_rows = $this->Lesson_Model->total();
        $config = $this->my_paginationlib->_Pagination('index.php/lesson/index', $total_rows);
        $this->pagination->initialize($config); 
        $data['list_pagination'] = $this->pagination->create_links();
        $total_page = ceil($config['total_rows'] / $config['per_page']); //ceil lấy phần nguyên
        $page = ($page > $total_page) ? $total_page : $page ;
        $page = ($page < 1) ? 1 : $page ;
        $page = $page - 1;

        if ($config['per_page'] > 0) {
            $data['list_lesson'] = $this->Lesson_Model->view(($page*$config['per_page']), $config['per_page']);
        } 
        $data['title'] = lang('title_lesson');
        $data['template'] = 'lesson/index';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function show($id) 
    {
        $data['lesson'] = $fag = $this->Lesson_Model->get(array('id' => $id));
        $data['category'] = $this->Category_Model->get(array('id' => $fag['category_id']));
        $data['title'] = lang('lesson');
        $data['template'] = 'lesson/show';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function add() 
    {
        if ($this->input->post('add_lesson')) {
            $this->set_rules();

            if($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'name' => $this->input->post('name'),
                );
                $fag = $this->Lesson_Model->insert($array);

                if ($fag > 0) {
                    $fag = array(
                        'type' => 'successful',
                        'message' => lang('add_lesson_successful'),
                    );
                } else {
                    $fag = array(
                        'type' => 'error',
                        'message' => lang('add_lesson_error'),
                    );
                }
                $this->session->set_flashdata('message_flashdata',$fag);
                redirect('lessons');	
            }
        }
        $data['list_category'] = $this->list_category();
        $data['meta_title'] = lang('title_add_lesson');
        $data['template'] = 'lesson/add';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function edit($id = 0) 
    {
        $data['lesson'] = $this->Lesson_Model->get(array('id' => $id));
        $this->check_data($data['lesson'], 0);

        if ($this->input->post('edit_lesson')) {
            $this->set_rules();

            if($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'name' => $this->input->post('name'),
                );
                $test = $this->Lesson_Model->update($id, $array);

                if ($test > 0) {
                    $fag = array(
                        'type' => 'successful',
                        'message' => lang('edit_lesson_successful'),
                    );
                } else {
                    $fag = array(
                        'type' => 'error',
                        'message' => lang('edit_lesson_error'),
                    );
                }
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('lessons');
            }
        }
        
        $data['list_category'] = $this->list_category();
        $data['meta_title'] = lang('title_edit_lesson');
        $data['template'] = 'lesson/edit';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        $data['lesson'] = $this->Lesson_Model->get(array('id' => $id));
        $this->check_data($data['lesson'], 0);
        $fag = $this->Lesson_Model->delete((array)$id);

        if ($fag > 0) {
            $fag = array(
                'type' => 'successful',
                'message' => lang('delete_lesson_successful'),
            );
        } else {
            $fag = array(
                'type' => 'error',
                'message' => lang('delete_lesson_error'),
            );
        }
        $this->session->set_flashdata('message_flashdata', $fag);
        redirect('lessons');
    }

    protected function set_rules()
    {
        $this->form_validation->set_rules('name', lang('lesson'), 'trim|required' );
        $this->form_validation->set_rules('category', lang('category'), 'callback_check_rule_category' );
        $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');
    }
}
