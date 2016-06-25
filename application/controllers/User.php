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
}
