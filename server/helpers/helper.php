<?php

class helper
{
    public static function Output_Error($code = null, $message = null)
    {
        header('Content-Type:application/json');
        if (isset($code)) {
            if (is_int($code)) {
                switch ($code) {
                    case 400: $message = !is_null($message) ? $message : 'Bad Request';
                    break;
                    case 401: $message = !is_null($message) ? $message : 'Unauthorized';
                    break;
                    case 404:  $message = !is_null($message) ? $message : 'Requested resource not found';
                    break;
                    case 405:  $message = !is_null($message) ? $message : 'Method Not Allowed';
                    break;
                    case 500:  $message = !is_null($message) ? $message : 'Whoops! somthing went wrong, our engineers have been notified';
                  break;
                    default:
                    isset($message) ? $message : '';
                }
                http_response_code($code);
            }
        }
        $response = [];
        if (!is_null($code)) {
            $response['code'] = $code;
        }
        $response['error'] = $message;
        echo json_encode($response);
    }

    public static function Output_Success($data)
    {
        header('Content-Type:application/json');
        echo json_encode($data);
    }

    public static function SendMail($message, $to, $subject, $isHTML = null)
    {
        include_once __DIR__.'/../phpmailer/PHPMailerAutoload.php';

        $AppMail = new PHPMailer(true);
        try {
            $AppMail->isSMTP(); // Send using SMTP
            $AppMail->Host = 'agrorite.com'; // Set the SMTP server to send through
            $AppMail->SMTPAuth = true; // Enable SMTP authentication
            $AppMail->SMTPSecure = 'tls'; //Enable TLS authentication
            // $AppMail->SMTPDebug = SMTP::DEBUG_SERVER;
            $AppMail->Username = 'test@agrorite.com'; // SMTP username
            $AppMail->Password = ')[eD1mAhR(8V'; // SMTP password
               // $AppMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $AppMail->Port = 587; // TCP port to connect to
               //Recipients
            $AppMail->setFrom('hello@agrorite.com', 'Reaprite Limited');   // Add Sender
            $AppMail->addAddress($to);
            // Content
            $AppMail->isHTML(true); // Set email format to HTML
            $AppMail->Subject = "$subject";
            $AppMail->Body = "$message";
            $AppMail->send();

            return 'success';
        } catch (Exception $e) {
            if (APP_DEBUG === true) {
                // echo 'error '.self::$AppMail->ErrorInfo;
                return $e;
            } else {
                return 'error';
            }
        }
    }

    // email template

    public static function contactForm($fullname, $email, $phone, $message, $subject)
    {
        return '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <!-- If you delete this tag, the sky will fall on your head -->
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="https://fonts.google.com/specimen/Open+Sans+Condensed?selection.family=Open+Sans+Condensed:300;lang=en" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Rite Holdings Limited</title>
        <style type="text/css" >
        /* ------------------------------------- 
                GLOBAL 
        ------------------------------------- */


        * { 
            margin:0;
            padding:0;
        }



        img { 
            max-width: 100%; 
        }
        .collapse {
            margin:0;
            padding:0;
        }
        body {
            -webkit-font-smoothing:antialiased; 
            -webkit-text-size-adjust:none; 
            width: 100%!important; 
            height: 100%;
        }


        /* ------------------------------------- 
                ELEMENTS 
        ------------------------------------- */
        a { color: #2BA6CB;}

        .btn {
            text-decoration:none;
            color: #FFF;
            background-color: #666;
            padding:10px 16px;
            font-weight:bold;
            margin-right:10px;
            text-align:center;
            cursor:pointer;
            display: inline-block;
        }

        p.callout {
            padding:15px;
            background-color:#ECF8FF;
            margin-bottom: 15px;
        }
        .callout a {
            font-weight:bold;
            color: #2BA6CB;
        }

        table.social {
        /* 	padding:15px; */
            background-color: #ebebeb;
            
        }
        .social .soc-btn {
            padding: 3px 7px;
            font-size:12px;
            margin-bottom:10px;
            text-decoration:none;
            color: #FFF;font-weight:bold;
            display:block;
            text-align:center;
        }
        a.fb { background-color: #3B5998!important; }
        a.tw { background-color: #1daced!important; }
        a.gp { background-color: #DB4A39!important; }
        a.ms { background-color: #000!important; }

        .sidebar .soc-btn { 
            display:block;
            width:100%;
        }

        /* ------------------------------------- 
                HEADER 
        ------------------------------------- */
        table.head-wrap { width: 100%;}

        .header.container table td.logo { padding: 15px; }
        .header.container table td.label { padding: 15px; padding-left:0px;}


        /* ------------------------------------- 
                BODY 
        ------------------------------------- */
        table.body-wrap { width: 100%;}


        /* ------------------------------------- 
                FOOTER 
        ------------------------------------- */
        table.footer-wrap { width: 100%;	clear:both!important;
        }
        .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}
        .footer-wrap .container td.content p {
            font-size:10px;
            font-weight: bold;
            
        }


        /* ------------------------------------- 
                TYPOGRAPHY 
        ------------------------------------- */
        h1,h2,h3,h4,h5,h6 {
        font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;
        }
        h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }

        h1 { font-weight:200; font-size: 44px;}
        h2 { font-weight:200; font-size: 37px;}
        h3 { font-weight:500; font-size: 27px;}
        h4 { font-weight:500; font-size: 23px;}
        h5 { font-weight:900; font-size: 17px;}
        h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}

        .collapse { margin:0!important;}

        p, ul { 
            margin-bottom: 10px; 
            font-weight: normal; 
            font-size:14px; 
            line-height:1.6;
        }
        p.lead { font-size:17px; }
        p.last { margin-bottom:0px;}

        ul li {
            margin-left:5px;
            list-style-position: inside;
        }

        /* ------------------------------------- 
                SIDEBAR 
        ------------------------------------- */
        ul.sidebar {
            background:#ebebeb;
            display:block;
            list-style-type: none;
        }
        ul.sidebar li { display: block; margin:0;}
        ul.sidebar li a {
            text-decoration:none;
            color: #666;
            padding:10px 16px;
        /* 	font-weight:bold; */
            margin-right:10px;
        /* 	text-align:center; */
            cursor:pointer;
            border-bottom: 1px solid #777777;
            border-top: 1px solid #FFFFFF;
            display:block;
            margin:0;
        }
        ul.sidebar li a.last { border-bottom-width:0px;}
        ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}



        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display:block!important;
            max-width:600px!important;
            margin:0 auto!important; /* makes it centered */
            clear:both!important;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            padding:15px;
            max-width:600px;
            margin:0 auto;
            display:block; 
        }


        .content table { width: 100%; }


        /* Odds and ends */
        .column {
            width: 300px;
            float:left;
        }
        .column tr td { padding: 15px; }
        .column-wrap { 
            padding:0!important; 
            margin:0 auto; 
            max-width:600px!important;
        }
        .column table { width:100%;}
        .social .column {
            width: 280px;
            min-width: 279px;
            float:left;
        }

        /* Be sure to place a .clear element after each set of columns, just to be safe */
        .clear { display: block; clear: both; }


        /* ------------------------------------------- 
                PHONE
                For clients that support media queries.
                Nothing fancy. 
        -------------------------------------------- */
        @media only screen and (max-width: 600px) {
            
            a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

            div[class="column"] { width: auto!important; float:none!important;}
            
            table.social div[class="column"] {
                width:auto!important;
            }

        }
        </style>

        </head>
        
        <body bgcolor="#FFFFFF">

        <!--
        <table class="head-wrap" style="text-align:center" >
            <tr style="text-align:center" > 
                <td style="text-align:center" > <img src="" border="0" alt="Reaprite" style="width:150px" > </td>
            </tr>
        </table>
        -->


        <!-- BODY -->
        <table class="body-wrap">
            <tr>
                <td></td>
                <td class="container" bgcolor="#FFFFFF">

                    <div class="content">
                    <table>
                        <tr>
                            <td>
                                
                                <h4 style="font-family:calibri"> Hi Admin,</h4>
                                <p style="font-family:calibri"> A Reaprite User Just sent a message. See details below </b> </p>  
                                <p style="font-family:calibri"> Subject: '.$subject.' </b> </p>  
                                <p style="font-family:calibri"> Email: <a href="mailto:'.$email.'">'.$email.'</a> </b> </p>  
                                <p style="font-family:calibri"> Fullname: '.$fullname.' </b> </p>  
                                <p style="font-family:calibri"> Mobile: <a href="tel:'.$phone.'">'.$phone.'</a> </b> </p>  
                                <p style="font-family:calibri"> Message: '.$message.' </b> </p>  
                                
                                
                                <br>
                                <p> <b> Rite Holdings Team </b> </p>
                                
                            </td>
                        </tr>
                    </table>
                    </div>
                                            
                </td>
                <td></td>
            </tr>
        </table><!-- /BODY -->


        </body>
        </html>';
    }
}
