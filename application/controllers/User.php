<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->authentication = $this->my_authentication->check();   
    }

    public function index()
    {
        
        if (!isset($this->authentication) && count($this->authentication) == 0) {
            redirect('sessions/login');
        }
        $data['template'] = 'user/index';
        $this->load->view('layout/index', $data);
    }
}
