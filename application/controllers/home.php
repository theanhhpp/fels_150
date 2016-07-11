<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('lesson', 'fels');
        $this->lang->load('word', 'fels');
        $this->lang->load('category', 'fels');
        $this->lang->load('user', 'fels');
        $this->authentication = $this->my_authentication->check();
    }
    
    public function index() 
    {
        $data['title'] = lang('name_project');
        if (!isset($this->authentication) && count($this->authentication) == 0) {
            $this->load->view('layout/home_page', $data);
        } else {
            $data['template'] = 'layout/static_page';
            $data['authentication'] = $this->authentication;
            $this->load->view('layout/index', $data);
        }
    }
}
