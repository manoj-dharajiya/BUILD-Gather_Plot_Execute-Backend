<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if(!function_exists('pr')) {
    function pr($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}
if(!function_exists('pre')){
    function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        exit();
    }
}
if(!function_exists('convertToReadableSize')){
    function formatSize($size){
        $base = log($size) / log(1024);
        $suffix = array("b", "KB", "MB", "GB", "TB");
        $f_base = floor($base);
        if($f_base<0){$f_base = 0;}
        return round(pow(1024, $base - floor($base)), 1) . ' '. $suffix[$f_base];
    }
}
if(!function_exists('checkValuesPost')){
    function checkValuesPost($values){
        $result = true;
        if(!empty($values)){
            foreach ($values as $value) {
                if(empty($_POST[$value])){
                    $result = false;
                }
            }
        }
        return $result;
    }
}
if(!function_exists('checkValuesGet')){
    function checkValuesGet($values){
        $result = true;
        if(!empty($values)){
            foreach ($values as $value) {
                if(empty($_GET[$value])){
                    $result = false;
                }
            }
        }
        return $result;
    }
}
if(!function_exists('fnShowOutput')){
    function fnShowOutput($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
if(!function_exists('fnShowOutputHtml')){
    function fnShowOutputHtml($data){
        header('Content-Type: text/html');
        echo "<div id='response'>".json_encode($data)."</div>";
        exit();
    }
}
if(!function_exists('fnSendMail')){
    function fnSendMail($sendToName, $sendToEmail, $mailSubject, $mailBody ){
        $ci = get_instance();
        $sendFromEmail = $ci->config->item('mailSendFromEmail');
        $sendFromUsername = $ci->config->item('mailSendFromUsername');
        $sendFromPass = $ci->config->item('mailSendFromPass');
        $sendFromName = $ci->config->item('mailSendFromName');
        $sendFromHost = $ci->config->item('mailSendFromHost');
        $sendFromPort = $ci->config->item('mailSendFromPort');
        $mailBody = '<html>'.$mailBody."</html>";
        
        $ci->load->library('PHPMailer');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "ssl"; 
        $mail->Host       = $sendFromHost;
        $mail->Port       = $sendFromPort;
        $mail->Username   = $sendFromUsername;
        $mail->Password   = $sendFromPass;
        $mail->SetFrom($sendFromEmail, $sendFromName);
        $mail->AddReplyTo($sendFromEmail,$sendFromName);
        $mail->Subject    = $mailSubject;
        $mail->msgHTML($mailBody, dirname(__FILE__));
        $mail->AddAddress($sendToEmail, $sendToName);
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}
if(!function_exists('fnSendPushNotificationAndroid')){
    function fnSendPushNotificationAndroid($registrationIds, $notificationData){
        if(!is_array($registrationIds)){
            $registrationIds = array($registrationIds);
        }
        $ci = get_instance();
        $googleAPIKey  = $ci->config->item('googleAPIKey');
        $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $googleAPIKey);
        $data = array(
            'notification' => $notificationData,
            'data' => array(
                'data' => array(
                    'type' => $notificationData['type'],
                    'note_id' => $notificationData['note_id'],
                    'title' => $notificationData['title'],
                ),
            ),
            'registration_ids' => $registrationIds
        );
        $url = 'https://fcm.googleapis.com/fcm/send';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
if(!function_exists('fnSendPushNotificationIphone')){
    function fnSendPushNotificationIphone($deviceToken, $notificationData){
        // Put your private key's passphrase here:
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', ROOT_PATH.'/certificates/push2.pem');
        
        stream_context_set_option($ctx, 'ssl', 'passphrase', '');

        // Open a connection to the APNS server
        //sandbox
        //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        //Production
        //$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        if (!$fp){
            //echo "<br/>ERROR in connection";
            return false;
        }

        // Create the payload body
        $body['aps'] = $notificationData; 
        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $response = '';
        $result = fwrite($fp, $msg, strlen($msg));
        
        if (!$result){
            $response = false;
        }
        else{
            $response = true;
        }
        // Close the connection to the server
        fclose($fp);
        return $response;
    }
}

/*
* Get User IP
*/
if(!function_exists('get_visitor_ip')){
    function get_visitor_ip() {
        $ip = '';
        
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = 'none';
    
        // if (getenv('HTTP_CLIENT_IP'))
        //     $ip = getenv('HTTP_CLIENT_IP');
        // else if(getenv('HTTP_X_FORWARDED_FOR'))
        //     $ip = getenv('HTTP_X_FORWARDED_FOR');
        // else if(getenv('HTTP_X_FORWARDED'))
        //     $ip = getenv('HTTP_X_FORWARDED');
        // else if(getenv('HTTP_FORWARDED_FOR'))
        //     $ip = getenv('HTTP_FORWARDED_FOR');
        // else if(getenv('HTTP_FORWARDED'))
        //     $ip = getenv('HTTP_FORWARDED');
        // else if(getenv('REMOTE_ADDR'))
        //     $ip = getenv('REMOTE_ADDR');
        // else
        //     $ip = 'none';
    
        return $ip;
    }
}


function getRemainingDays($datestr){

    $date = explode('/',$datestr);
    $datestr = $date[2].'-'.$date[0].'-'.$date[1]." 23:59:59";   

    //Convert to date    
    $date=strtotime($datestr); //Converted to a PHP date (a second count)

    //Calculate difference
    $diff = $date-time(); //time returns current time in seconds
    
    if($diff > 0){        
        $days=floor($diff/(60*60*24)); //seconds/minute*minutes/hour*hours/day)
        $hours = round(($diff-$days*60*60*24)/(60*60));        

        if(!empty($days) && $days > 0){
            $string = "$days days $hours hours left";
        }else if(!empty($hours) && $hours > 0){
            $string = "$hours hours left";
        }
    }else{
        $string = "Voucher Expired.";
    }
       
    return $string;
} 

function send_mail($to,$subject,$message,$is_smtp = false) {

    if($is_smtp) {
        return fnSendMail('',$to,$subject,$message);
    }

    $ci = get_instance();
    $from_email  = $ci->config->item('from_email');
    $site_name  = $ci->config->item('site_name');

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // More headers
    $headers .= 'From: '.$site_name.' <'.$from_email.'>' . "\r\n";

    $mailBody = '<html>'.$message."</html>";

    /* ================================================================================= */

    return @mail($to,$subject,$mailBody,$headers);
}