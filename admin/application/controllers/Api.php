<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    private $become_partner_list = 'become_partner_list';
    private $focus_group_list = 'focus_group_list';
    private $want_in_list = 'want_in_list';
    private $donations = 'donations';
    
    private $adminEmail = "";
    private $site_name = "";

    function __construct() {
        parent::__construct();
        $this->set_admin_options();
    }

    public function set_admin_options() {
        $this->adminEmail = $this->common->fnGetOptions('admin_email');        
        $this->site_name = ' | '.$this->common->fnGetOptions('site_name').' | '.$this->common->fnGetOptions('site_description');
    }

    public function add_focus_group_list() {
        $requests = $_POST;
        $params = ['fname','lname','email','phone'];

        try {

            $checkResult = checkValuesPost($params);

            if($checkResult) {
                $where = array('email'=>$requests['email']);
                $islaredyThere = $this->common->fnGetWhere($this->focus_group_list,$where);

                if(!$islaredyThere) {

                    $data = array (
                        'fname'=> $requests['fname'],
                        'lname'=> $requests['lname'],
                        'email'=> $requests['email'],
                        'phone'=> $requests['phone'],
                        'social_plateform'=> $requests['social_plateform'],
                        'handle_url'=> $requests['handle_url'],
                        'add_time'=> time()
                    );

                    $this->common->fnInsertData($this->focus_group_list,$data);

                    $this->notify_focus_group();

                    $output = array(                
                        'type' => 'success',
                        'message' => 'Thank you for your request!',
                    );
                } else {
                    $output = array(                
                        'type' => 'error',
                        'message' => 'The Email is already requested!',
                    );
                }

            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'Required Parameters are missing.',                    
                );    
            }
        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }

        fnShowOutput($output);
        exit;        
    }
    public function add_become_partner_list() {

        $requests = $_POST;
        $params = ['fname','lname','email','phone'];

        try {

            $checkResult = checkValuesPost($params);
            if($checkResult) {
                $where = array('email'=>$requests['email']);
                $islaredyThere = $this->common->fnGetWhere($this->become_partner_list,$where);

                if(!$islaredyThere) {

                    $data = array (
                        'fname'=> $requests['fname'],
                        'lname'=> $requests['lname'],
                        'email'=> $requests['email'],
                        'phone'=> $requests['phone'],
                        'social_plateform'=> $requests['social_plateform'],
                        'handle_url'=> $requests['handle_url'],
                        'parnership_offering'=> $requests['parnership_offering'],
                        'additional_info'=> $requests['additional_info'],
                        'add_time'=> time()
                    );

                    $this->common->fnInsertData($this->become_partner_list,$data);
                    $this->notify_become_partners();

                    $output = array(                
                        'type' => 'success',
                        'message' => 'Thank you for your request!',
                    );
                } else {
                    $output = array(                
                        'type' => 'error',
                        'message' => 'The Email is already requested!',
                    );
                }

            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'Required Parameters are missing.',                    
                );    
            }
        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }

        fnShowOutput($output);
        exit;

    }
    public function add_want_in_list() {
        $requests = $_POST;
        $params = ['fname','lname','email','phone'];

        try {

            $checkResult = checkValuesPost($params);
            if($checkResult) {
                $where = array('email'=>$requests['email']);
                $islaredyThere = $this->common->fnGetWhere($this->want_in_list,$where);

                if(!$islaredyThere) {

                    $data = array (
                        'fname'=> $requests['fname'],
                        'lname'=> $requests['lname'],
                        'email'=> $requests['email'],
                        'phone'=> $requests['phone'],
                        'social_plateform'=> $requests['social_plateform'],
                        'handle_url'=> $requests['handle_url'],
                        'add_time'=> time()
                    );

                    $this->common->fnInsertData($this->want_in_list,$data);
                    $this->notify_i_want_in();

                    $output = array(                
                        'type' => 'success',
                        'message' => 'Thank you for your request!',
                    );
                } else {
                    $output = array(                
                        'type' => 'error',
                        'message' => 'The Email is already requested!',
                    );
                }

            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'Required Parameters are missing.',                    
                );    
            }
        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }

        fnShowOutput($output);
        exit;

    }
    public function add_donate_now() {

        try {

            $stipeKeys = $this->common->fnGetUnserializeOptions('stripe');

            if(isset($stipeKeys['sk_key'])) {

                $posts = $_POST;
                $token = json_decode($posts['token']);
                $amount = $posts['amount'];

                $description = "Donation from ".$token->email;

                $stripe = new Stripe();
                $paymentStatus = $stripe->excute_payment($stipeKeys['sk_key'],$token,$amount,$description);
                
                if($paymentStatus->status == "succeeded") {

                    $insertData = array(
                        'name'=>"",
                        "email" => $token->email,
                        "amount" => $amount,
                        "transaction_id" => $paymentStatus->id,
                        "receipt_url" => $paymentStatus->receipt_url,
                        'add_time' => time()
                    );
                    $this->common->fnInsertData($this->donations,$insertData);

                    $this->notify_about_donation($insertData);

                    $output = array(
                        'type' => "success",
                        "message" => "Thank you for the donation.",
                        "transaction_id" => $paymentStatus->id
                    );
                } else if(isset($paymentStatus['type']) && $paymentStatus['type'] == "error") {
                    $output = $paymentStatus;
                } else {
                    $output = array(                
                        'type' => 'error',
                        'message' => 'Something went wrong. Please try again.',
                    );
                }
            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'Something went wrong. Please try again.',
                    'dev_message' => "Stripe Credentials are missing."
                );
            }

        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }
        fnShowOutput($output);
        exit;
    }
    public function get_settings() {

        try {

            $stripeKeys = $this->common->fnGetUnserializeOptions('stripe');
            $countdown = $this->common->fnGetUnserializeOptions('countdown');
            $youtube_id = $this->common->fnGetOptions('youtube_id');
            $timeStamp = "";

            if(isset($countdown['date']) && isset($countdown['time'])) {

                $date = explode('-',$countdown['date']);
                $time = explode(":",$countdown['time']);

                $timeStamp = mktime($time[0],$time[1],0,$date[1],$date[2],$date[0]);
            }

            $settings = array(
                'stripe_pk_key' => $stripeKeys['pk_key'],
                'youtube_id' => $youtube_id,
                'countdown_end' => $timeStamp,
            );

            $output = array(
                "type" => "success",
                "settings" => $settings,
            );


        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }
        fnShowOutput($output);
        exit;
    }

    public function notify_focus_group() {

        $requests = $_REQUEST;

        try {

            $name = (isset($requests['fname']) && isset($requests['lname']))?$requests['fname'].' '.$requests['lname']:"";
            $email = (isset($requests['email']))?$requests['email']:"";
            $phone = (isset($requests['phone']))?$requests['phone']:"";
            $social_plateform = (isset($requests['social_plateform']))?$requests['social_plateform']:"";
            $handle_url = (isset($requests['handle_url']))?$requests['handle_url']:"";

            $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

            $subject = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['admin']['subject'])?$notification_mails['focus_group']['admin']['subject']:"";
            $message = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['admin']['content'])?$notification_mails['focus_group']['admin']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);

            $adminEmail = $this->adminEmail;
            send_mail($adminEmail,$subject,$message,true);
    
            $subject = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['user']['subject'])?$notification_mails['focus_group']['user']['subject']:"";
            $message = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['user']['content'])?$notification_mails['focus_group']['user']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);
            
            send_mail($email,$subject,$message,true);

        } catch (Exception $e) {

        }

    }
    public function notify_i_want_in() {

        $requests = $_REQUEST;

        try {

            $name = (isset($requests['fname']) && isset($requests['lname']))?$requests['fname'].' '.$requests['lname']:"";
            $email = (isset($requests['email']))?$requests['email']:"";
            $phone = (isset($requests['phone']))?$requests['phone']:"";
            $social_plateform = (isset($requests['social_plateform']))?$requests['social_plateform']:"";
            $handle_url = (isset($requests['handle_url']))?$requests['handle_url']:"";

            $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

            $subject = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['admin']['subject'])?$notification_mails['i_want_in']['admin']['subject']:"";
            $message = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['admin']['content'])?$notification_mails['i_want_in']['admin']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);

            $adminEmail = $this->adminEmail;
            send_mail($adminEmail,$subject,$message,true);
    
            $subject = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['user']['subject'])?$notification_mails['i_want_in']['user']['subject']:"";
            $message = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['user']['content'])?$notification_mails['i_want_in']['user']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);
            
            send_mail($email,$subject,$message,true);

        } catch (Exception $e) {
            
        }

    }
    public function notify_become_partners() {

        $requests = $_REQUEST;

        try {

            $name = (isset($requests['fname']) && isset($requests['lname']))?$requests['fname'].' '.$requests['lname']:"";
            $email = (isset($requests['email']))?$requests['email']:"";
            $phone = (isset($requests['phone']))?$requests['phone']:"";
            $social_plateform = (isset($requests['social_plateform']))?$requests['social_plateform']:"";
            $handle_url = (isset($requests['handle_url']))?$requests['handle_url']:"";
            $parnership_offering = (isset($requests['parnership_offering']))?$requests['parnership_offering']:"";
            $additional_info = (isset($requests['additional_info']))?$requests['additional_info']:"";

            $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

            $subject = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['admin']['subject'])?$notification_mails['become_partners']['admin']['subject']:"";
            $message = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['admin']['content'])?$notification_mails['become_partners']['admin']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);
            $message = str_replace('[parnership_offering]',$parnership_offering,$message);
            $message = str_replace('[additional_info]',$additional_info,$message);

            $adminEmail = $this->adminEmail;
            send_mail($adminEmail,$subject,$message,true);
    
            $subject = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['user']['subject'])?$notification_mails['become_partners']['user']['subject']:"";
            $message = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['user']['content'])?$notification_mails['become_partners']['user']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Phone]',$phone,$message);
            $message = str_replace('[Social_plateform]',$social_plateform,$message);
            $message = str_replace('[handle_url]',$handle_url,$message);
            $message = str_replace('[parnership_offering]',$parnership_offering,$message);
            $message = str_replace('[additional_info]',$additional_info,$message);
            
            send_mail($email,$subject,$message,true);

        } catch (Exception $e) {
            
        }

    }
    public function notify_about_donation($donationData) {

        $requests = $_REQUEST;

        try { 
            
            $name = ($donationData['name'] !="")?$donationData['name']:$donationData['email'];
            $email = $donationData['email'];
            $Amount = $donationData['amount'];
            $receipt_url = "<a href=".$donationData['receipt_url'].">Download Reciept</a>";

            $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

            $subject = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['admin']['subject'])?$notification_mails['donate_now']['admin']['subject']:"";
            $message = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['admin']['content'])?$notification_mails['donate_now']['admin']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Amount]',$Amount,$message);
            $message = str_replace('[receipt_url]',$receipt_url,$message);

            $adminEmail = $this->adminEmail;
            send_mail($adminEmail,$subject,$message,true);
    
            $subject = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['user']['subject'])?$notification_mails['donate_now']['user']['subject']:"";
            $message = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['user']['content'])?$notification_mails['donate_now']['user']['content']:"";

            $subject = str_replace('[Name]',$name,$subject);
            $message = str_replace('[Name]',$name,$message);
            $message = str_replace('[Email]',$email,$message);
            $message = str_replace('[Amount]',$Amount,$message);
            $receipt_url = "<a href=".$donationData['receipt_url'].">Download Reciept</a> ";
            send_mail($email,$subject,$message,true);

        } catch (Exception $e) {
            
        }

    }
}