<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->lang->load('word', 'fels');
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->authentication = $this->my_authentication->check();        
    }

    public function check_authentication ()
    {
        if (!isset($this->authentication) && count($this->authentication) == 0) {
            redirect('sessions/login');
        }
    }

    public function list_category()
    {
        $total = $this->Category_Model->total();
        $list_category = $this->Category_Model->view_category(0, $total);
        $list[0] = lang('choose_catrgory');

        if (isset($list_category) && count($list_category)) {

            foreach ($list_category as $key => $value) {
                $list[$value['id']] = $value['name'];
            }
        }
        return $list;
    }

    public function check_rule_category($category = '')
    {
        if($category == 0) {
            $this->form_validation->set_message('check_rule_category', lang('check_rule_category'));
            return FALSE;  
        }
        return TRUE;
    }

    public function checkpassword($password_confirmation = '') 
    {
        $password = $this->input->post('password');

        if ($password != $password_confirmation) {
            $this->form_validation->set_message('checkpassword', lang('check_password'));
            return FALSE;
        }
        return TRUE;
    }

    public function checkemail($email = '') 
    {
        $user = $this->User_Model->get(array('email' => $email));

        if (isset($user) && count($user)) {

            if ($user == $this->authentication) {
                return TRUE;        
            } else {
                $this->form_validation->set_message('checkemail', lang('check_email'));
                return FALSE;          
            }  
        }
        return TRUE;    
    }
    
    public function _action() 
    {
        if($this->input->post('delete_more')) {
            $checkbox = $this->input->post('checkbox');

            if (isset($checkbox) && count($checkbox)) {
                $fag = $this->Lesson_Model->delete($checkbox);
            }   
            
            if ($fag > 0) {
            $fag = [
                    'type' => 'successful',
                    'message' => lang('delete_lesson_successful'),
                ];
            } else {
                $fag = [
                    'type' => 'error',
                    'message' => lang('delete_lesson_error'),
                ];
            }
            $this->session->set_flashdata('message_flashdata', $fag);
            redirect('lessons');        
        }        
    }

    public function check_data($data, $redirect)
    {
        if (!isset($data) || count($data) == 0) {
            $fag = [
                'type' => 'error',
                'message' => lang('no_word'),
            ]; 
            $this->session->set_flashdata('message_flashdata', $fag);
            redirect($redirect);
        } 
    }

    public function fag_messge($fag, $check, $message_successful, $message_error)
    {
        if ($fag > 0 || $check > 0) {
            $fag_messge = [
                'type' => 'successful',
                'message' => $message_successful,
            ];
        } else {
            $fag_messge = [
                'type' => 'error',
                'message' => $message_error,
            ];
        }
        return $fag_messge;
    }
    public function is_admin($user) 
    {
        if($user['admin'] == 1) {
            return TRUE;
        }
        return FALSE;
    }

    public function template($template1, $template2) 
    {
        if ($this->is_admin($this->authentication)) {
            $template = $template1;
        } else {
            $template = $template2;
        }
        return $template;
    }

    public function check_action($controller, $action)
    {
        $data = [
            'category' => ['add', 'edit', 'delete'],
            'lesson' => ['add', 'edit', 'delete'],
            'word' => ['add', 'edit', 'delete'],
            'lesson_word' => ['add', 'delete'],
        ];
        if (!$this->is_admin($this->authentication)) {
            
            if (in_array($action, $data[$controller])) {
                redirect ('users');
            }
        }       
        return NULL;
    }
}
