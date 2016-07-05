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
        $this->lang->load('category', 'fels');
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

    public function show($id) 
    {
        $data['word'] = $fag = $this->Word_Model->get_word(array('id' => $id));
        $data['word_answer'] = $word_answer = $this->Word_Answer_Model->get_answer(array('word_id' => $fag['id'], 'correct' => 1));
        $data['title'] = lang('word');
        $data['template'] = 'word/show';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function add() 
    {
        if ($this->input->post('add_word')) {
            $this->set_rules();

            if($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'content' => $this->input->post('content'),
                );
                $fag = $this->Word_Model->insert($array);
                $checkbox = $this->input->post('checkbox');
                $check = $this->set_word_answer(NULL, $checkbox, $fag['insert_id'], 0);

                if ($fag['affected_rows'] > 0) {
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
        $total = $this->Category_Model->total();
        $list_category = $this->Category_Model->view_category(0, $total);
        $list[0] = lang('choose_catrgory');

        if (isset($list_category)&& count($list_category)) {
            foreach ($list_category as $key => $value) {
                $list[$value['id']] = $value['name'];
            }
        }
        $data['list_category'] = $list;
        $data['meta_title'] = lang('title_add_word');
        $data['template'] = 'word/add';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function edit($id = 0) 
    {
        $data['word'] = $this->Word_Model->get_word(array('id' => $id));
        $data['list_word_answer'] = $list_word_answer = $this->Word_Answer_Model->get_answer(array('word_id' => $id));

        if (!isset($data['word']) || count($data['word']) == 0) {
            $fag = array(
                'type' => 'error',
                'message' => lang('no_word'),
            );
            $this->session->set_flashdata('message_flashdata',$fag);
            redirect('words');
        }

        if ($this->input->post('edit_word')) {
            $this->set_rules();
            
            if ($this->form_validation->run()) {
                $array = array(
                    'category_id' => $this->input->post('category'),
                    'content' => $this->input->post('content'),
                );
                $fag = $this->Word_Model->update($id, $array);
                $checkbox = $this->input->post('checkbox');
                $check = $this->set_word_answer($list_word_answer, $checkbox, $id, 1);

                if ($fag > 0 || $check > 0) {
                    $fag = array (
                        'type' => 'successful',
                        'message' => lang('edit_word_successful'),
                    );
                } else {
                    $fag = array (
                        'type' => 'error',
                        'message' => lang('edit_word_error'),
                    );
                }
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('words');
            }
        }
        $total = $this->Category_Model->total();
        $list_category = $this->Category_Model->view_category(0, $total);
        $list[0] = lang('choose_catrgory');

        if (isset($list_category)&& count($list_category)) {
            foreach ($list_category as $key => $value) {
                $list[$value['id']] = $value['name'];
            }
        }
        $data['list_category'] = $list;
        $data['meta_title'] = lang('title_edit_word');
        $data['template'] = 'word/edit';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        $word = $this->Word_Model->get_word(array('id' => $id));
        $list_word_answer = $this->Word_Answer_Model->get_answer_id(array('word_id' => $word['id']));

        if (!isset($word) || count($word) == 0) {
            $fag = array(
                'type' => 'error',
                'message' => lang('no_word'),
            );
            $this->session->set_flashdata('message_flashdata', $fag);
            redirect('words');
        }
        $fag = $this->Word_Model->delete((array)$id);
        $fag = $this->Word_Answer_Model->delete($list_word_answer);

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

    protected function _action() 
    {
        if($this->input->post('delete_more')) {
            $checkbox = $this->input->post('checkbox');

            if (isset($checkbox) && count($checkbox)) {

                foreach ($checkbox as $key => $value) {
                    $list_word_answer = $this->Word_Answer_Model->get_answer_id(array('word_id' => $value));       
                }
                $fag = $this->Word_Model->delete($checkbox);
                $fag = $this->Word_Answer_Model->delete($list_word_answer);
            }
                        
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

    protected function set_rules()
    {
        $this->form_validation->set_rules('content', lang('word'), 'trim|required' );
        $this->form_validation->set_rules('answer[]', lang('answer'), 'trim|required' );
        $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');
    }

    protected function set_word_answer ($param_where, $list_checkbox, $id ,$fag)
    {
        $check = 0;
        for ($i = 0; $i < 4; $i++) {
            if (in_array($i, $list_checkbox)) {
                $array_word_answer = array(
                    'content' => $this->input->post('answer['.$i.']'),
                    'word_id' => $id,  
                    'correct' => 1,
                );
            } else {
                $array_word_answer = array(
                    'content' => $this->input->post('answer['.$i.']'),
                    'word_id' => $id,
                    'correct' => 0,                        
                );
            }
            
            if ($fag == 1) {
                $fag1 = $this->Word_Answer_Model->update($param_where[$i]['id'], $array_word_answer);
                if ($fag1 > 0) $check = 1;    
            } else {
                $fag1 = $this->Word_Answer_Model->insert($array_word_answer);
                if ($fag1 > 0) $check = 1;
            }
        }
        return $check;
    }
}
