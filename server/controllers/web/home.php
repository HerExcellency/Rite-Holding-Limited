<?php

class home extends ServerController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['page_title'] = 'Reaprite - bringing you closer to your financial goals and dreams with secure savings and investment platform.';
        $data['menu_active'] = 'home'; // the menu active tab
        $this->loadView('index', @$data);
    }

    public function subscribe()
    {
        if ($this->requestMethod != 'post') {
            return helper::Output_Error(null, 'Invalid request');
        }
        //if the post data is JSON, use this
        $body = $this->getPostData()->post;
        $email = validator::GetInputValueString(@$body, 'email');

        if ($email === '' || !validator::IsEmail($email)) {
            return helper::Output_Error(null, 'A valid email is required');
        }
        $apiKey = 'cdf68a5e4898a9ec326c3669e9e67b2c-us17';
        $listID = 'd87b4b35fa';
        // MailChimp API URL
        $memberID = md5(strtolower($email));
        $dataCenter = substr($apiKey, strpos($apiKey, '-') + 1);
        $url = 'https://'.$dataCenter.'.api.mailchimp.com/3.0/lists/'.$listID.'/members/'.$memberID;
        // member information
        $json = json_encode(
            ['email_address' => $email,
            'status' => 'subscribed',
            'tags' => ['Web Subscribers'],
            ]);

        // send a HTTP POST request with curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:'.$apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // store the status message based on response code
        if ($httpCode == 200 || $httpCode == 214) {
            return helper::Output_Success(['success' => 'Subscribed']);
        } else {
            return helper::Output_Error(null, 'Opps there was an error performing this task please try again later');
        }
    }
}
