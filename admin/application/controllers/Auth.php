<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    private $userTable = 'users';
    
    private $adminEmail = "";
    private $site_name = "";

    function __construct() {
        parent::__construct();

        $this->adminEmail = $this->common->fnGetOptions('admin_email');
    }

    public function set_admin_options() {
        $this->adminEmail = $this->common->fnGetOptions('admin_email');        
        $this->site_name = ' | '.$this->common->fnGetOptions('site_name').' | '.$this->common->fnGetOptions('site_description');
    }

    // public function index() {
    //     echo "User Auth API.";
    // }


    public function index() {

        $user = $this->isUserLogin();

        if($user) {
            if($user['user_type'] == "Administrator") {
                $redirect = base_url().'dashboard';
            } else {
                $redirect = base_url();
            }
            fn_redirect($redirect);
            exit;
        }

        $output = "";
        if(isset($_REQUEST['action'])){
            $output = $this->login();            
        }

        $data = array(			
            'pageTitle' => 'Login | Bussiness Profiles',
            'errorMeesage' => $output,
		);

		$this->load->view('Login.php', $data);
    }
    public function signup_page() {

        $user = $this->isUserLogin();

        if($user) {
            if($user['user_type'] == "Administrator") {
                $redirect = base_url().'admin';
            } else {
                $redirect = base_url();
            }
            fn_redirect($redirect);
            exit;
        }

        $output = "";
        if(isset($_REQUEST['action'])){
            $output = $this->signup();            
        }

        $data = array(			
            'pageTitle' => 'Signup | Bussiness Profiles',
            'errorMeesage' => $output,
		);

		$this->load->view('Signup.php', $data);
    }

    public function veify_user() {
        $userId = $this->uri->segment(2);

        $sql = "select * from users where md5(id) = '".$userId."'";
        $user = $this->common->fnCustomQuery($sql);        

        if($user) {

            if($user[0]['is_email_verified'] == 'unverified') {
                $data = array('is_email_verified'=>'verified');
                $where = array('id'=>$user[0]['id']);
                $this->common->fnUpdateData($this->users,$data,$where);
            }

            $message = array(
                'type' => 'success',
                'message' => 'Thank you for verifying your Email!',
            );
        } else {
            $message = array(
                'type' => 'error',
                'message' => 'We are having problem to verifying your Email. Please try again later!',
            );
        }

        $siteLogo = base_url()."/assets/images/blackBusinesLogo.png";
        $data = array(			
            'pageTitle' => 'Email Verification | Bussiness Profiles',
            'message' => $message,
            'site_logo' => $siteLogo,
            'user' => $user
		);
        $this->load->view('VerifyUser.php', $data);
    } 

    private function isUserLogin() {

        global $user;

        $access_token = $this->session->userdata('access_token');
        $user = $this->verify_access_token($access_token);

        if(!isset($user['type'])) {
            return $user;
        } else {
            return false;
        }
        
    }


    /**
     * Creating Access Token
     * @param Array $userData - Userdata that need to be include in Accesstoken
     * 
     */
    private function create_access_token($userData) {
        $tokenKey = $this->config->item('tokenKey');
        $token = JWT::encode($userData, $tokenKey);

        return $token;
    }

    /**
     * Verify the Access Token
     * @param String $accessToken
     */
    public function verify_access_token($accessToken) {
        $tokenKey = $this->config->item('tokenKey'); 
        
        try {
        
            if($accessToken) {

                $userData = JWT::decode($accessToken, $tokenKey);

                if(isset($userData->valid_upto)){
                    $timenow = time();
                    if($timenow > $userData->valid_upto){
                        return array(
                            'type' => 'error',
                            'message' => 'Access token expired.'
                        );
                    }
                }       
                
                @$user = $this->common->fnGetWhere('users', array('id' => $userData->user_id))[0]; 
            } else {
                return false;
            }      
            
            return $user;

        } catch(Exception $e) {

        }
    }

    /**
     * Verify the Admin User
     * @param String access_token 
     */
    public function verify_admin() {
        $headers = $this->input->request_headers();

        if(isset($headers['access_token'])){
            $user = $this->verify_access_token($headers['access_token']);
            return (strtolower($user['user_type'])=="administrator");
        } if(isset($headers['authorization'])){

            $access_token = explode(" ",$headers['authorization']);

            $user = $this->verify_access_token(trim($access_token[1]));
            return (strtolower($user['user_type'])=="administrator");            
        } else {
            return false;
        }
    }
    
    /** 
     * User Login Api Modual
     * @param String email - Email Address Of the user
     * @param String pssword - Password Of the user
     * 
     */
    public function login() {

        $requests = $_REQUEST;       

        try {

            $params = ['email', 'password'];
            $checkResult = checkValuesPost($params);

            if($checkResult) {
                
                $user = $this->common->fnGetWhere($this->userTable,array('email' => $requests['email']));
                
                if($user) {                                        

                    if($user[0]['password'] == md5($requests['password'])) {

                        $tempInitials = explode(' ',$user[0]['name']);                        
                        if(is_array($tempInitials)){
                            $initials = "";
                            for($i=0;$i<count($tempInitials);$i++) {
                                $initials .= strtoupper(substr($tempInitials[$i],0,1));
                            }
                        }else{
                            $initials = strtoupper(substr($user[0]['name'],0,1));
                        }

                        $userData = array(
                            'user_id' => $user[0]['id'],
                            'email' => $user[0]['email'],
                            'initials'=> $initials
                        );                        

                        if(isset($user[0]['user_type'])){
                            $userData['user_type'] = $user[0]['user_type'];
                        }                        

                        $access_token = $this->create_access_token($userData);

                        $this->session->set_userdata('user_id',$user[0]['id']);
                        $this->session->set_userdata('access_token',$access_token);
                        
                        if($userData['user_type'] == 'Administrator'){
                            $redirect = base_url().'admin/dashboard';
                        }else{
                            $redirect = base_url();
                        }                        
                        fn_redirect($redirect);            
                        exit;
                        
                    } else {

                        $output = array(                            
                            'type' => 'error',
                            'message' => 'Invalid password. Please try again.'
                        );    
                    }

                } else {
                    $output = array(                        
                        'type' => 'error',
                        'message' => 'No user available with this email.'
                    );    
                }

            } else {
                $output = array(                    
                    'type' => 'error',
                    'message' => 'Email and Password is required.'
                );
            }

        } catch(Exception $e) {
            $$output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }   
        return $output;     
    }
    public function signup() {

        $requests = $_REQUEST;       

        try {

            $params = ['name','email','password','cpassword'];
            $checkResult = checkValuesPost($params);

            if($checkResult) {
                
                $user = $this->common->fnGetWhere($this->userTable,array('email' => $requests['email']));
                
                if(!$user) {

                    $userData = array (
                        'name' => $requests['name'],
                        'email' => $requests['email'],
                        'password' => md5($requests['password']),
                        'user_type' => 'Subscriber',
                        'status' => 'Active',
                        'add_time' => time(),
                    );
                    
                    $userId = $this->common->fnInsertData('users',$userData);
                    $user = $this->common->fnGetWhere($this->userTable,array('id'=>$userId));

                    if($user) {
                        $this->send_notification($user);

                        $userData = array(
                            'user_id' => $userId,
                            'email' => $requests['email'],
                        );

                        if(isset($user[0]['user_type'])) {
                            $userData['user_type'] = $user[0]['user_type'];
                        }                        

                        $access_token = $this->create_access_token($userData);

                        $this->session->set_userdata('user_id',$user[0]['id']);
                        $this->session->set_userdata('access_token',$access_token);

                        $redirect = base_url();

                        $output = array(
                            'type' => 'success',
                            'message' => "Registration Successful!"
                        );
                                        
                        fn_redirect($redirect);
                        exit;

                    } else {
                        $output = array(                    
                            'type' => 'error',
                            'message' => 'Email and Password is required.'
                        );
                    }                    
                } else {
                    $output = array(
                        'type' => 'error',
                        'message' => 'Email is already registered!'
                    );
                }
            } else {
                $output = array(                    
                    'type' => 'error',
                    'message' => 'All Fields are required.'
                );
            }
        } catch(Exception $e) {
            $output = array(                
                'type' => 'error',
                'message' => 'Something went wrong. Please try again.',
                'message_dev' => $e->getMessage()
            );
        }   
        return $output;     
    }
    private function send_notification($user) {

        $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

        $email = $user[0]['email'];
        $verificationLink = base_url().'/verify/'.md5($user[0]['id']);

        $subject = (isset($notification_mails['signup']) && $notification_mails['signup']['user']['subject'])?$notification_mails['signup']['user']['subject']:"";
        $message = (isset($notification_mails['signup']) && $notification_mails['signup']['user']['content'])?$notification_mails['signup']['user']['content']:"";       

        $message = str_replace('[Name]',$user[0]['name'],$message);
        $message = str_replace('[Email]',$user[0]['email'],$message);
        $message = str_replace('[Password]',$_REQUEST['password'],$message);
        $message = str_replace('[Verification_link]',$verificationLink,$message);
        
        $adminNotify = send_mail($email,$subject,$message,true);

        /* ============== Admin Notification ============== */

        $email = $this->adminEmail;

        $subject = (isset($notification_mails['signup']) && $notification_mails['signup']['admin']['subject'])?$notification_mails['signup']['admin']['subject']:"";
        $message = (isset($notification_mails['signup']) && $notification_mails['signup']['admin']['content'])?$notification_mails['signup']['admin']['content']:"";

        $message = str_replace('[Name]',$user[0]['name'],$message);
        $message = str_replace('[Email]',$user[0]['email'],$message);
        
        $adminNotify = send_mail($email,$subject,$message,true);
    }
    public function logout_user() {
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('user_id');
        $redirect = base_url();
        fn_redirect($redirect);
        exit;
    }    

    /**
     * Get Users Lists - 
     * @param String page - Pagging number
     */
    public function get_users() {
        
        try {

            $is_admin = $this->verify_admin();

            if($is_admin){

                $page = ($this->uri->segment(4))?$this->uri->segment(4):1;

                $limit = '20';                
                $start = ($page - 1 ) * $limit;                

                $sql = "select * from ". $this->userTable." ORDER BY id DESC limit ".$start.",".$limit;
                $users = $this->common->fnCustomQuery($sql);

                // $newUsersList = [];
                // foreach($users as $user) {
                //     $temp = array(
                //         'id' => $user['id'],
                //         'name' => $user['name'],
                //         'email' => $user['email'],
                //         'user_type' => $user['user_type'],
                //         'company_id' => $user['company_id'],
                //     );
                // }
                
                $output = array(                
                    'type' => 'success',
                    'users' => $users
                );

            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'You are not allowed to perform the action.',
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

    /**
     * Verify Access Token using API
     */
    public function veify_request_token() {

        $access_token = $this->uri->segment(3);

        try {
            $user = $this->verify_access_token($access_token);
            if(isset($user['type']) && $user['type'] == "error") {
                $output = $user;
            }else{
                $output = array('type' => 'success');
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

    /**
     * Forgot Password
     * @param email - Email of the User
     */
    public function forgot_password_request() {

        $user = $this->isUserLogin();

        if($user) {
            if($user['user_type'] == "Administrator") {
                $redirect = base_url().'admin';
            } else {
                $redirect = base_url();
            }
            fn_redirect($redirect);
            exit;
        }

        $requests = $_REQUEST;
        $message = "";        

        if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'forgot_request') {
            $message = $this->send_forgot_request();
        }
    
        $data = array(			
            'pageTitle' => 'Forgot Password | Bussiness Profiles',
            'message' => $message,
        );
    
        $this->load->view('forgot-pass.php', $data);           

    }

    function send_forgot_request() {

        $requests = $_REQUEST;

        if(isset($requests['email']) && $requests['email'] == "") {

            $message = array(                    
                'type' => 'error',
                'message' => 'Please provide valid email.'
            );

        } else{

            $uData = array('email'=>$requests['email']);
            $user = $this->common->fnGetWhere($this->userTable,$uData);                    

            if($user) {
                
                $valid_upto = 60 * 60; // 1 Hour
                $userData = array(
                    'user_id' => $user[0]['id'],
                    'email' => $user[0]['email'],
                    'valid_upto' => time() + $valid_upto
                );               

                $access_token = $this->create_access_token($userData);
                $updateUrl = base_url().'update-password/'.$access_token;

                $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');
                
                $subject = (isset($notification_mails['forgot_password']) && $notification_mails['forgot_password']['user']['subject'])?$notification_mails['forgot_password']['user']['subject']:"";
                $message = (isset($notification_mails['forgot_password']) && $notification_mails['forgot_password']['user']['content'])?$notification_mails['forgot_password']['user']['content']:"";
                
                $message = str_replace('[Name]',$user[0]['name'],$message);
                $message = str_replace('[Email]',$user[0]['email'],$message);
                $message = str_replace('[Password_link]',$updateUrl,$message);

                $email = $requests['email'];

                send_mail($email,$subject,$message,true);

                $message = array(                    
                    'type' => 'success',
                    'message' => "Please kindly check your email to the update you password."
                );

            } else {
                $message = array(                    
                    'type' => 'error',
                    'message' => 'User does not exists.'
                );
            }
        }
        return $message;
    }

    /**
     * Update Password
     * @param password - New Password     
     */
    public function update_password() {

        $user = $this->isUserLogin();

        if($user) {
            if($user['user_type'] == "Administrator") {
                $redirect = base_url().'admin';
            } else {
                $redirect = base_url();
            }
            fn_redirect($redirect);
            exit;
        }

        $requests = $_REQUEST;        
        $message = "";

        $accessToken = ($this->uri->segment(2))?$this->uri->segment(2):"";

        if($accessToken) {

            $isValid = $this->verify_access_token($accessToken);

            if($isValid) {                

                if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'update_password') {

                    $userData = array('password'=>md5($requests['password']));
                    $this->common->fnUpdateData($this->userTable,$userData,array('id'=>$isValid['id']));

                    $message = array(
                        'type' => 'success',
                        'message' => 'Password Updated Successfully.'
                    );
                }

            } else {
                $message = array(
                    'type' => 'error',
                    'message' => 'The Link is not valid anymore please try again with Forgot Password.'
                );
            }
            
        } else {
            $message = array(
                'type' => 'error',
                'message' => 'Please check the Link or please try again with Forgot Password.'
            );
        }   
        

        $data = array(			
            'pageTitle' => 'Update Password | Bussiness Profiles',
            'message' => $message,
        );
    
        $this->load->view('update-pass.php', $data);
    }
    
}