<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->check_authentication();
        $this->check_action('user', $this->router->fetch_method());
    }

    public function index($page = 1)
    {
        $total_rows = $this->User_Model->total();
        $config = $this->my_paginationlib->_Pagination('user/index', $total_rows);
        $this->pagination->initialize($config); 
        $data['list_pagination'] = $this->pagination->create_links();
        $total_page = ceil($config['total_rows'] / $config['per_page']); //ceil lấy phần nguyên
        $page = ($page > $total_page) ? $total_page : $page ;
        $page = ($page < 1) ? 1 : $page ;
        $page = $page - 1;

        if ($config['per_page'] > 0) {
            $data['list_user'] = $this->User_Model->view(($page*$config['per_page']), $config['per_page']);
        }
        $data['title'] = lang('users');
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
                $fag = $this->fag_messge($fag, 0, lang('update_successful'), lang('update_error'));
                $email =  $this->input->post('email');
                $user = $this->User_Model->get(array('email' => $email));
                $this->session->set_userdata('authentication', json_encode($user));
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('');     
            }
        }

        $data['title'] = lang('title_edit');
        $data['authentication'] = $this->authentication;
        $data['template'] = 'user/edit';
        $this->load->view('layout/index', $data);
    }

    public function show($id = 1 , $aciton = NULL, $page = 1)
    {
        $id = (int) $id;
        if ($aciton == 'following' || $aciton == 'followers') {

            if ($aciton == 'following') {
                $total_rows = $this->Relationship_Model->count_followings($id);
                $config = $this->my_paginationlib->_Pagination('user/show/' . $id . '/following', $total_rows);
            } elseif ($aciton == 'followers') {
                $total_rows = $this->Relationship_Model->count_followers($id);
                $config = $this->my_paginationlib->_Pagination('user/show/' . $id . '/followers', $total_rows);
            }           
            $this->pagination->initialize($config); 
            $data['list_pagination'] = $this->pagination->create_links();
            $total_page = ceil($config['total_rows'] / $config['per_page']);
            $page = ($page > $total_page) ? $total_page : $page ;
            $page = ($page < 1) ? 1 : $page ;
            $page = $page - 1;

            if ($config['per_page'] > 0) {
                if ($aciton == 'followers') {
                    $data['list_user'] = $this->Relationship_Model->followers($id, ($page*$config['per_page']), $config['per_page']);
                } elseif ($aciton == 'following') {
                    $data['list_user'] = $this->Relationship_Model->followings($id, ($page*$config['per_page']), $config['per_page']);
                }
            }
            $data['title'] = lang('users');
            $data['template'] = 'user/index';
        } else {
            $per_page = 5;
            $data['list_result'] = $this->Result_Model->view(0, $per_page, ['user_id' => $id]);
            $data['title'] = lang('title_show');
            $data['template'] = 'user/profile';
        }
        $data['authentication'] = $this->authentication;
        $data['user'] = $this->User_Model->get(['id' => $id]);
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        $data['user'] = $this->User_Model->get(['id' => $id]);
        $this->check_data($data['user'], 'users');
        $fag = $this->User_Model->delete((array) $id);
        $fag = $this->fag_messge($fag, 0, lang('delete_user_successful'), lang('delete_user_error'));
        $this->session->set_flashdata('message_flashdata', $fag);
        redirect('users');
    }

    public function getAll()
    {
        $per_page = 5;
        $page = $this->input->get('page');
        $id = $this->input->get('id');
        $data['list_result']= $this->Result_Model->view(0, $per_page * $page, ['user_id' => $id]);
        $this->load->view('user/result', $data);
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
