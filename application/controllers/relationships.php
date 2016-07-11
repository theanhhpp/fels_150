<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Relationships extends My_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        $this->check_authentication();
        $this->check_action('relationships', $this->router->fetch_method());
    }

    public function create()
    {
        if ($this->input->post('follow')) {
            $other_user_id = $this->input->post('method');
            $this->Relationship_Model->follow($this->authentication['id'], $other_user_id);
            redirect('user/show/'. $other_user_id);	
        }
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function delete($id = 0) 
    {
        if ($this->input->post('unfollow')) {
            $other_user_id = $this->input->post('method');
            $this->Relationship_Model->unfollow($this->authentication['id'], $other_user_id);
            redirect('user/show/'. $other_user_id);	
        }
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }
}
