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

        if (!isset($this->authentication) && count($this->authentication) == 0) {
            redirect('sessions/login');
        }
    }
}
