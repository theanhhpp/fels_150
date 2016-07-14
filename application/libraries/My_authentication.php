<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_authentication 
{

    private $CI;

    public function __construct() 
    {
        $this->CI =& get_instance();
    }

    public function check() 
    {
        $authentication = $this->CI->session->userdata('authentication');
        
        if (!isset($authentication) || empty($authentication)) {
            return NULL;
        }
        $authentication = json_decode($authentication, TRUE);

        if($authentication['oauth_provider'] == 'facebook' || $authentication['oauth_provider'] == 'google') {
            $user = $this->CI->User_Model->get(['oauth_provider' => $authentication['oauth_provider']]);
        } else {
            $user = $this->CI->User_Model->get([
                'email' => $authentication['email'],
                'password' => $authentication['password'],
                'http_user_agent' => $authentication['http_user_agent']
            ]);
            if (!isset($user) || count($user) == 0) {
                $this->CI->session->unset_userdata('authentication');
                return NULL;
            }
        }
        return $user;
    }
}
