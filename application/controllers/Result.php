<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->check_authentication();
    }

    public function create() 
    {
        $lesson_id = $this->input->post('lesson_id');
        $array = $this->input->post('check');
        $result = 0;

        foreach ($array as $key => $value) {
            $word_answer = $this->Word_Answer_Model->get_answer(['id' => $value]);

            if ($word_answer[0]['correct'] == 1) {
                $result ++;
            }
        }
        $data = [
            'user_id' => $this->authentication['id'],
            'lesson_id' => $this->input->post('lesson_id'),
            'result' => $result,
        ];
        $this->Result_Model->insert($data);
        redirect('user/show/'.$this->authentication['id']);
    }
}
