<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home', 'fels');
        $this->lang->load('session', 'fels');
        $this->lang->load('user', 'fels');
        $this->authentication = $this->my_authentication->check();   
    }

    public function index()
    {
        if (!isset($this->authentication) && count($this->authentication) == 0) {
            redirect('sessions/login');
        }
        $data['template'] = 'user/index';
        $data['authentication'] = $this->authentication;
        $this->load->view('layout/index', $data);
    }

    public function sign_up() 
    {
        if ($this->input->post('sign-up')) {
            $this->check_rules();

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
                $this->session->set_userdata('authentication', json_encode($user));
                $this->session->set_flashdata('message_flashdata', $fag);
                redirect('users');     
            }
        }
        $data['title'] = lang('title_sign_up');   
        $data['template'] = 'user/sign_up';
        $this->load->view('layout/home_page', $data);
    }

    public function show()
    {
        $config = $this->my_auth->check();
        // Google Project API Credentials
        $clientId = $config['clientId'];
        $clientSecret = $config['clientSecret'];
        // Facebook API Configuration
        $appId = $config['appId'];
        $appSecret = $config['appSecret'];
        $redirectUrl = base_url() . 'index.php/user/show';
        $fbPermissions = 'email';        
        //Call Facebook API
        $facebook = new Facebook(array(
            'appId'  => $appId,
            'secret' => $appSecret  
        ));
        $fbuser = $facebook->getUser();    
        if ($fbuser) {
            $userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'. $userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];
            // Insert or update user data
            $userID = $this->User_Model->checkUser($userData);
            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
            }
        } else {
            // Google Client Configuration
            $gClient = new Google_Client();
            $gClient->setApplicationName('Login to codexworld.com');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectUrl);
            $google_oauthV2 = new Google_Oauth2Service($gClient);

            if (isset($_REQUEST['code'])) {
                $gClient->authenticate();
                $this->session->set_userdata('token', $gClient->getAccessToken());
                redirect($redirectUrl);
            }

            $token = $this->session->userdata('token');
            if (!empty($token)) {
                $gClient->setAccessToken($token);
            }

            if ($gClient->getAccessToken()) {
                $userProfile = $google_oauthV2->userinfo->get();
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid'] = $userProfile['id'];
                $userData['first_name'] = $userProfile['given_name'];
                $userData['last_name'] = $userProfile['family_name'];
                $userData['locale'] = $userProfile['locale'];
                $userData['profile_url'] = $userProfile['link'];
                $userData['picture_url'] = $userProfile['picture'];
                // Insert or update user data
                $userID = $this->User_Model->checkUser($userData);
                if (!empty($userID)) {
                    $data['userData'] = $userData;
                    $this->session->set_userdata('userData', $userData);
                } else {
                   $data['userData'] = array();
                }
            } else {
                $data['authUrl'] = $gClient->createAuthUrl();
                $fbuser = '';
                $data['authUrlfb'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl, 'scope'=>$fbPermissions));
            }
        }
        $this->load->view('user/show', $data);
    }

    public function edit($id) 
    {
        if ($this->input->post('edit')) {
            $this->check_rules();
            
            if ($this->form_validation->run()) {
                $array = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                );
                $fag = $this->User_Model->update($array, array('id' => $this->authentication['id']));
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

    public function checkpassword($password_confirmation = '') 
    {
        $password = $this->input->post('password');

        if ($password != $password_confirmation) {
            $this->form_validation->set_message('checkpassword', lang('check_password'));
            return FALSE;
        }
        return TRUE;
    }

    public function checkemail($email = '') 
    {
        $user = $this->User_Model->get(array('email' => $email));

        if (isset($user) && count($user)) {

            if ($user == $this->authentication) {
                return TRUE;        
            } else {
                $this->form_validation->set_message('checkemail', lang('check_email'));
                return FALSE;          
            }  
        }
        return TRUE;    
    }

    public function check_rules() 
    {
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('email', lang('mail'), 'required|callback_checkemail');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirmation', lang('password_confirmation'), 'required|min_length[6]|callback_checkpassword');
        $this->form_validation->set_error_delimiters('<div style="color:red">', '</div>');
    }
}
