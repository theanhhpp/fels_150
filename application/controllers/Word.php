<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Word extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->lang->load('word', 'fels');
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
    }

    public function index($page = 1) 
    {
        $this->_action();
        $total_rows = $this->Word_Model->total();
        $config = $this->my_paginationlib->_Pagination('index.php/word/index', $total_rows);
        $this->pagination->initialize($config); 
        $data['list_pagination'] = $this->pagination->create_links();
        $total_page = ceil($config['total_rows'] / $config['per_page']); //ceil lấy phần nguyên
        $page = ($page > $total_page) ? $total_page : $page ;
        $page = ($page < 1) ? 1 : $page ;
        $page = $page - 1;

        if ($config['per_page'] > 0) {
            $data['list_word'] =$fag = $this->Word_Model->view(($page*$config['per_page']), $config['per_page']);
        }	
        $data['title'] = lang('title_word');
        $data['template'] = 'word/index';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function add() 
    {
        if ($this->input->post('add_word')) {
            $this->form_validation->set_rules('content', lang('word'), 'trim|required' );
            $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');

            if($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'content' => $this->input->post('content'),
                );
                $fag = $this->Word_Model->insert($array);

                if ($fag > 0) {
                    $fag = array(
                        'type' => 'successful',
                        'message' => lang('add_word_successful'),
                    );
                } else {
                    $fag = array(
                        'type' => 'error',
                        'message' => lang('add_word_error'),
                    );
                }
                $this->session->set_flashdata('message_flashdata',$fag);
                redirect('words');	
            }
        }
        // cái này em lấy dữ liệu để test thôi. chứ sau thì phải lấy từ bảng category ra ạ
        $data['list_category'] = array(
            '1' => 'category1',
            '2' => 'category2',
            '3' => 'category3',
            '4' => 'category4',
        );
        $data['meta_title'] = lang('title_add_word');
        $data['template'] = 'word/add';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function edit($id = 0) 
    {
        $data['word'] = $word = $this->Word_Model->get($id);

        if (!isset($data['word']) || count($data['word']) == 0) {
            $fag = array(
                'type' => 'error',
                'message' => lang('no_word'),
            );
            $this->session->set_flashdata('message_flashdata',$fag);
            redirect('words');
        }

        if ($this->input->post('edit_word')) {
            $this->form_validation->set_rules('content', lang('word'), 'trim|required' );
            $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');

            if($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'content' => $this->input->post('content'),
                );
                $fag = $this->Word_Model->update($id, $array);

                if ($fag > 0) {
                    $fag = array(
                        'type' => 'successful',
                        'message' => lang('edit_word_successful'),
                    );
                } else {
                    $fag = array(
                        'type' => 'error',
                        'message' => lang('edit_word_error'),
                    );
                }
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('words');
            }
        }
        $data['list_category'] = array(
            '1' => 'category1',
            '2' => 'category2',
            '3' => 'category3',
            '4' => 'category4',
        );
        $data['meta_title'] = lang('title_edit_word');
        $data['template'] = 'word/edit';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        $data['word'] = $word = $this->Word_Model->get($id);

        if (!isset($data['word']) || count($data['word']) == 0) {
            $fag = array(
                'type' => 'error',
                'message' => lang('no_word'),
            );
            $this->session->set_flashdata('message_flashdata', $fag);
            redirect('words');
        }
        $fag = $this->Word_Model->delete((array)$id);

        if ($fag > 0) {
            $fag = array(
                'type' => 'successful',
                'message' => lang('delete_word_successful'),
            );
        } else {
            $fag = array(
                'type' => 'error',
                'message' => lang('delete_word_error'),
            );
        }
        $this->session->set_flashdata('message_flashdata', $fag);
        redirect('words');
    }

    public function _action() 
    {
        if($this->input->post('delete_more')) {
            $checkbox = $this->input->post('checkbox');
            $fag = $this->Word_Model->delete($checkbox);
            
            if ($fag > 0) {
            $fag = array(
                'type' => 'successful',
                'message' => lang('delete_word_successful'),
                );
            } else {
                $fag = array(
                    'type' => 'error',
                    'message' => lang('delete_word_error'),
                );
            }
            $this->session->set_flashdata('message_flashdata', $fag);
            redirect('words');        
        }        
    }
}
