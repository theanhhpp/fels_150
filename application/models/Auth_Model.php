
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Model extends CI_Model
{

    public function auth()
    {
        $config = $this->my_auth->check();
        // Google Project API Credentials
        $clientId = $config['clientId'];
        $clientSecret = $config['clientSecret'];
        // Facebook API Configuration
        $appId = $config['appId'];
        $appSecret = $config['appSecret'];
        $redirectUrl = base_url() . 'index.php/sessions/show';
        $fbPermissions = 'email';        
        //Call Facebook API
        $facebook = new Facebook(array(
            'appId'  => $appId,
            'secret' => $appSecret
        ));
        $fbuser = $facebook->getUser();     
        if ($fbuser) {
            $redirect = 'users';
            redirect($redirect);
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
                $redirect = 'users';
                redirect($redirect);
            } else {
                $data['authUrl'] = $gClient->createAuthUrl();
                $fbuser = '';
                $data['authUrlfb'] = $facebook->getLoginUrl(array('redirect_uri'=> $redirectUrl, 'scope'=> $fbPermissions));
            }
        }
        return $data;
    }
}
