<?php

class contactUs extends ServerController
{
    public function __construct()
    {
    }

    public function index()
    {
       
        $this->loadView('contactUs');
    }
    public function process(){

        $body = $this->getPostData()->post;
            $email = validator::GetInputValueString(@$body, 'email');
            $fullname = validator::GetInputValueString(@$body, 'fullname');
            $phone = validator::GetInputValueString(@$body, 'phone');
            $subject1 = validator::GetInputValueString(@$body, 'subject');
            $desc = validator::GetInputValueString(@$body, 'message');
            $subject = $subject1 ? $subject1 : 'message to Admin';
            var_dump($body);  
            // var_dump('hello');  

            if ($fullname === '' || strlen($fullname) < 4) {
                return helper::Output_Error(null, 'Valid full name is required');
            }
            if ($phone === '' || strlen($phone) < 6 || strlen($phone) > 16) {
                return helper::Output_Error(null, 'A valid phone number is required');
            }
            if ($email === '' || !validator::IsEmail($email)) {
                return helper::Output_Error(null, 'A valid email is required');
            }
            if ($subject === '' || strlen($subject) < 3) {
                return helper::Output_Error(null, 'Please write a valid subject');
            }
            if ($desc === '' || strlen($desc) < 10) {
                return helper::Output_Error(null, 'Description must be more than 10 characters');
            }
            $message = helper::contactForm($fullname, $email, $phone, $desc, $subject);
            $to = 'ijeomaonuajurx@gmail.com';
            $sendMessage = helper::SendMail($message, $to, $subject, true);
            if ($sendMessage) {
                return helper::Output_Success(['status' => 'Your Message was sent successfully']);
            } else {
                return helper::Output_Error(null, 'There was an error during sending your message please try again');
            }
    }
}
