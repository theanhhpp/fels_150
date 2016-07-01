<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->authentication = $this->my_authentication->check();
    }

    public function sign_up() 
    {
        if ($this->input->post('sign-up')) {
            $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
            $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
            $this->form_validation->set_rules('email', lang('mail'), 'required|callback_checkemail');
            $this->form_validation->set_rules('password', lang('password'), 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirmation', lang('password_confirmation'), 'required|min_length[6]|callback_checkpassword');
            $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');

            if ($this->form_validation->run()) {
                $array = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                );
                $fag = $this->Session_Model->create($array);
                $email =  $this->input->post('email');
                $user = $this->User_Model->get(array('email' => $email));
                $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                $flag = $this->User_Model->update(array('http_user_agent' => $http_user_agent), array('email' => $email));
                $user['http_user_agent'] = $http_user_agent;
                $_SESSION['authentication'] = json_encode($user);
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('users');     
            }
        }
        $data['title'] = lang('title_sign_up');   
        $data['template'] = 'session/sign_up';
        $this->load->view('layout/home_page', $data);
    }

    public function login()
    {   
        $data = $this->Auth_Model->auth();
        if (isset($this->authentication) && count($this->authentication) > 0) {
            redirect('users');
        }

        if ($this->input->post('login')) {
            $this->form_validation->set_rules('password', lang('password'), 'callback_authentication' );
            $this->form_validation->set_error_delimiters('<div style="color:red">','</div>');
            
            if ($this->form_validation->run()) {
                $email =  $this->input->post('email');
                $user = $this->User_Model->get(array('email' => $email));
                $http_user_agent = $_SERVER['HTTP_USER_AGENT'];
                $flag = $this->User_Model->update(array('http_user_agent' => $http_user_agent), array('email' => $email));
                $user['http_user_agent'] = $http_user_agent;

                if ($flag['type'] = 'seccessful') {
                    $remember = (int)$this->input->post('remember');
                    $user['http_user_agent'] = $http_user_agent;
                    $this->session->set_userdata('authentication', json_encode($user));
                    $fag1 =  array(
                        'type' => 'seccessful',
                        'message' => lang('login_seccessful'),
                    );
                    $this->session->set_flashdata('message_flashdata', $fag1);
                    redirect('users');     
                }                 
            }
        }
        $data['title'] = lang('title_sign_in'); 
        $data['template'] = "session/login";
        $this->load->view('layout/home_page', $data);
    }

    public function logout() 
    {
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('userData');
        $this->session->unset_userdata('auth');    
        $this->session->unset_userdata('authentication');
        $this->session->sess_destroy();
        redirect('users');
    }
    
    public function authentication($password = '') 
    {
        $email = $this->input->post('email');
        $count = $this->User_Model->total(array('email' => $email));

        if ($count == 0) {
            $this->form_validation->set_message('authentication', lang('email_fail'));
            return FALSE;
        }
        $user = $this->User_Model->get(array('email' => $email));

        if ($user['password'] != md5($password)) {
            $this->form_validation->set_message('authentication', lang('password_fail'));
            return FALSE;
        }
        return TRUE;
    }
}
