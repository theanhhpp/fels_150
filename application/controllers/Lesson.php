<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->check_authentication();
        $this->check_action('lesson', $this->router->fetch_method());
    }

    public function index($page = 1) 
    {
        $this->_action();
        $total_rows = $this->Lesson_Model->total();
        $config = $this->my_paginationlib->_Pagination('lesson/index', $total_rows);
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
        $data['template'] = $this->template('lesson/index', 'user/lesson'); 
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function show($id) 
    {
        if (!isset($id) || count($id) == 0) {
            redirect('lessons');
        }
        $data['lesson'] = $this->Lesson_Model->get(['id' => $id]);
        $data['category'] = $this->Category_Model->get_category_id(['id' => $data['lesson']['category_id']]);
        $list_lesson_word = $this->Lesson_Word_Model->get(['lesson_id' => $id]);
        $i = 0;
        foreach ($list_lesson_word as $key => $value) {
            $word = $this->Word_Model->get_word(['id' => $value['word_id']]);

            if(isset($word) && count($word)) {
                $list_word[$i] = $this->Word_Model->get_word(['id' => $value['word_id']]);
                $list_word[$i]['lesson_word_id'] = $value['id'];
                $list_word [$i]['word_anser'] = $this->Word_Answer_Model->get_answer(['word_id' => $value['word_id']]);
                $i++;   
            }            
        }
        if (isset($list_word) && count($list_word)) {
            $data['list_word'] = $list_word;
        }
        $data['title'] = lang('lesson');
        $data['authentication'] = $this->authentication;
        $data['template'] = $this->template('lesson/show', 'user/show_lesson');     
        $this->load->view('layout/index', $data);
    }

    public function add() 
    {
        if ($this->input->post('add_lesson')) {
            $this->set_rules();

            if ($this->form_validation->run()) {
                $array = [
                    'category_id' => $this->input->post('category'),
                    'name' => $this->input->post('name'),
                ];
                $fag = $this->Lesson_Model->insert($array);
                $fag = $this->fag_messge($fag, 0,lang('add_lesson_successful'), lang('add_lesson_error'));
                $this->session->set_flashdata('message_flashdata', $fag);
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
        $data['lesson'] = $this->Lesson_Model->get(['id' => $id]);
        $this->check_data($data['lesson'], 'lessons');

        if ($this->input->post('edit_lesson')) {
            $this->set_rules();

            if ($this->form_validation->run()) {
                $array = [
                    'category_id' => $this->input->post('category'),
                    'name' => $this->input->post('name'),
                ];
                $fag = $this->Lesson_Model->update($id, $array);
                $fag = $this->fag_messge($fag, 0, lang('edit_word_successful'), lang('add_word_error'));
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
        $data['lesson'] = $this->Lesson_Model->get(['id' => $id]);
        $this->check_data($data['lesson'], 'lessons');
        $fag = $this->Lesson_Model->delete((array) $id);
        $fag = $this->fag_messge($fag, 0, lang('delete_lesson_successful'), lang('delete_lesson_error'));
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
