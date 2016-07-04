<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson_Word extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->lang->load('lesson', 'fels');
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('category', 'fels');
    }

    public function add() 
    {
        $lesson_id = $this->input->get('lesson_id');
        $data['lesson'] = $this->Lesson_Model->get(['id' => $lesson_id]);
        $data['category'] = $this->Category_Model->get_category_id(['id' => $data['lesson']['category_id']]);

        if ($this->input->post('add_word')) {
            $list_word_id = $this->input->post('checkbox');
            $this->check_data($list_word_id, 'lesson_word/add?lesson_id=' . $lesson_id);
            foreach ($list_word_id as $key => $value) {
                $array = ['lesson_id' => $data['lesson']['id'], 'word_id' => $value];
                $fag = $this->Lesson_Word_Model->insert($array);   
            }
            $fag = $this->fag_messge($fag, lang('edit_word_successful'), lang('add_word_error'));
            $this->session->set_flashdata('message_flashdata',$fag);
            redirect('lesson/show/'.$lesson_id);	
        }
        $total = $this->Word_Model->total();
        $data['list_word'] = $this->Word_Model->view(0, $total, ['category_id' => $data['lesson']['category_id']]);
        $data['meta_title'] = lang('title_add_lesson');
        $data['template'] = 'lesson_Word/add';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }
    public function delete($id) 
    {
        $id = (int) $id;
        $lesson_word = $this->Lesson_Word_Model->get(['id' => $id]);
        $this->check_data($lesson_word, 'lesson/show/'. $lesson_word[0]['lesson_id']);
        $fag = $this->Lesson_Word_Model->delete($id);
        $fag = $this->fag_messge($fag, lang('delete_lesson_successful'), lang('delete_lesson_error'));
        $this->session->set_flashdata('message_flashdata', $fag);
        redirect('lesson/show/'.$lesson_word[0]['lesson_id']);
    }
}
