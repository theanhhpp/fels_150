<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_paginationlib
{	
    public function _Pagination($base_url, $total_rows)
    {	
        $config['per_page'] = 5;
        $config['base_url'] = base_url().$base_url;
        $config['total_rows'] = $total_rows;
        $config['full_tag_open'] = '<ul class="pagination" style ="margin: 0 0;">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a>';
        $config['cur_tag_close'] = '</li></a>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['use_page_numbers'] = TRUE;
        return $config;    
    }   
}
