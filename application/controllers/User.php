<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('user', 'fels');
        $this->lang->load('category', 'fels');
    }

    public function index()
    {
        $data['template'] = 'user/index';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function edit($id) 
    {
        if ($this->input->post('edit')) {
            $this->set_rules();
            
            if ($this->form_validation->run()) {
                $array = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                );
                $fag = $this->User_Model->update($array, array('id' => $this->authentication['id']));
                $fag = $this->fag_messge($fag, lang('update_successful'), lang('update_error'));
                $email =  $this->input->post('email');
                $user = $this->User_Model->get(array('email' => $email));
                $this->session->set_userdata('authentication', json_encode($user));
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('users');     
            }
        }

        $data['title_edit'] = lang('title_edit');
        $data['authentication'] = $this->authentication;
        $data['template'] = 'user/edit';
        $this->load->view('layout/index', $data);
    }

    public function set_rules() 
    {
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('email', lang('mail'), 'required|callback_checkemail');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', lang('password_confirmation'), 'required|min_length[6]|callback_checkpassword');
        $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
    }
}
