<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');	
    }
    public function index() 
    {
        $data['title'] = lang('name_project');
        $this->load->view('layout/home_page', $data);
    }
}
