<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Learned_Word extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->check_authentication();
        $this->authentication = $this->my_authentication->check();
    }

    public function learn($id) {
        $word = $this->Word_Model->get_word(['id' => $id]);
        $data['word_same_date'] = $this->Learned_Word_Model->word_same_date($this->authentication['id']);
        $array = ['word_id' => $word['id'], 'user_id' => $this->authentication['id']];
        $learn_word = $this->Learned_Word_Model->total($array); 
        if($learn_word == 0) {
            $this->Learned_Word_Model->insert($array);
        }
        $data['authentication'] = $this->authentication; 
        header('Location:' . $this->input->get('redirect'));    
    }


}
