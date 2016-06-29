<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_auth
{

    public function check() 
    {
        // Include the facebook api php libraries
        include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
         // Include the google api php libraries
        include_once APPPATH."libraries/google-api-php-client/Google_Client.php";
        include_once APPPATH."libraries/google-api-php-client/contrib/Google_Oauth2Service.php";
        // Google Project API Credentials
        $clientId = '88064622450-2lvnlsjkt0mlss3459ct9683r9pctomm.apps.googleusercontent.com';
        $clientSecret = 'ypn__exMlzS0Wk2YQotaTYzZ';
        // Facebook API Configuration
        $appId = '584057951766356';
        $appSecret = '58083aecb2e95dba09ee9ab11fa27cb2';
        $config['clientId'] = $clientId;
        $config['clientSecret'] = $clientSecret;
        $config['appId'] = $appId;
        $config['appSecret'] = $appSecret;
        return $config;
    }
}
