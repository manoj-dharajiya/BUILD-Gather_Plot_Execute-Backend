<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once(__DIR__.'/Auth.php');

class Admin extends Auth {

    private $focus_group_list = "focus_group_list";
    private $become_partner_list = "become_partner_list";
    private $want_in_list = "want_in_list";
    
    private $settings = "settings";

    private $adminEmail = "";
    private $site_name = "";    

    private $users = 'users';

    function __construct() {
        parent::__construct();
        $this->verifyAdmin();
        $this->set_admin_options();
    }

    public function set_admin_options() {
        $this->adminEmail = $this->common->fnGetOptions('admin_email');        
        $this->site_name = ' | '.$this->common->fnGetOptions('site_name').' | '.$this->common->fnGetOptions('site_description');
    }

    public function index() {}

    /**
     * Page Views
     */

    public function dashboard() {           

        $data = array(			
            'pageTitle' => 'Dashboard'.$this->site_name,			
        );

        $this->load->view('admin/Pages/Dashboard.php', $data);

    }

    public function focus_group_list() {

        $page = ($this->uri->segment(4))?$this->uri->segment(4):1;

        $message = "";

        if(isset($_REQUEST['action']) && $_REQUEST['action']=='removeFocusRequest') {
            $message = $this->removeFocusRequest($_REQUEST['id']);
        }        

        $limit = '20';                
        $start = ($page - 1 ) * $limit;        

        if((isset($_REQUEST['action']) && $_REQUEST['action'] == "search") && ((isset($_REQUEST['search']) && $_REQUEST['search'] != ""))){
            $search = $_REQUEST['search'];
            // echo "1";

            $sql = "select * from ". $this->focus_group_list." where fname like '%".$search."%' or email like '%".$search."%' ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->focus_group_list." where fname like '%".$search."%' or email like '%".$search."%'";

        } else {
            $sql = "select * from ". $this->focus_group_list." ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->focus_group_list;
        }
        
        $list = $this->common->fnCustomQuery($sql);
        $totalProducts = $this->common->fnCustomQuery($sql1);       

        $baseUrl = base_url().'focus-group-list';
        $baseUrl .= ($this->uri->segment(4))?"/page/".$page:"";

        $totalPages = ceil(count($totalProducts)/$limit);
        $totalItems = count($totalProducts);

        $previous = $page - 1;
        $previous = ($previous == 0)?'disable':base_url().'focus-group-list/page/'.$previous;

        $next = $page + 1;
        $next = ($next > $totalPages)?"disable":base_url().'focus-group-list/page/'.$next;

        if(isset($_REQUEST['search'])) {
            $baseUrl .= '?search='.$_REQUEST['search'];
            
            if($next != "disable") {
                $next .= '?search='.$_REQUEST['search'];
            }

            if($previous != 'disable'){
                $previous .= '?search='.$_REQUEST['search'];
            }
        }

        $data = array(			
            'pageTitle' => 'Participate In Focus Groups Requests '.$this->site_name,
            'lists' => $list,
            'message' => $message,
            'start' => $start + 1,
            'baseUrl' => $baseUrl,
            'pagging' => array(
                'next'=> $next,
                'previous'=> $previous,
                'total_item'=> $totalItems,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'limit' => $limit
            )
        );

        $this->load->view('admin/Pages/focus-list/index.php', $data);

    }

    public function become_partner_list() {

        $page = ($this->uri->segment(4))?$this->uri->segment(4):1;

        $message = "";

        if(isset($_REQUEST['action']) && $_REQUEST['action']=='removePartnerRequest') {
            $message = $this->removePartnerRequest($_REQUEST['id']);
        }        

        $limit = '20';                
        $start = ($page - 1 ) * $limit;        

        if((isset($_REQUEST['action']) && $_REQUEST['action'] == "search") && ((isset($_REQUEST['search']) && $_REQUEST['search'] != ""))){
            $search = $_REQUEST['search'];
            // echo "1";

            $sql = "select * from ". $this->become_partner_list." where fname like '%".$search."%' or email like '%".$search."%' ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->become_partner_list." where fname like '%".$search."%' or email like '%".$search."%'";

        } else {
            $sql = "select * from ". $this->become_partner_list." ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->become_partner_list;
        }
        
        $list = $this->common->fnCustomQuery($sql);
        $totalProducts = $this->common->fnCustomQuery($sql1);       

        $baseUrl = base_url().'become-partner-list';
        $baseUrl .= ($this->uri->segment(4))?"/page/".$page:"";

        $totalPages = ceil(count($totalProducts)/$limit);
        $totalItems = count($totalProducts);

        $previous = $page - 1;
        $previous = ($previous == 0)?'disable':base_url().'become-partner-list/page/'.$previous;

        $next = $page + 1;
        $next = ($next > $totalPages)?"disable":base_url().'become-partner-list/page/'.$next;

        if(isset($_REQUEST['search'])) {
            $baseUrl .= '?search='.$_REQUEST['search'];
            
            if($next != "disable") {
                $next .= '?search='.$_REQUEST['search'];
            }

            if($previous != 'disable'){
                $previous .= '?search='.$_REQUEST['search'];
            }
        }

        $data = array(			
            'pageTitle' => 'Become a Partner Requests '.$this->site_name,
            'lists' => $list,
            'message' => $message,
            'start' => $start + 1,
            'baseUrl' => $baseUrl,
            'pagging' => array(
                'next'=> $next,
                'previous'=> $previous,
                'total_item'=> $totalItems,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'limit' => $limit
            )
        );

        $this->load->view('admin/Pages/become-partner-list/index.php', $data);

    }
    
    public function want_in_list() {

        $page = ($this->uri->segment(4))?$this->uri->segment(4):1;

        $message = "";

        if(isset($_REQUEST['action']) && $_REQUEST['action']=='removeWantInRequest') {
            $message = $this->removeWantInRequest($_REQUEST['id']);
        }        

        $limit = '20';                
        $start = ($page - 1 ) * $limit;        

        if((isset($_REQUEST['action']) && $_REQUEST['action'] == "search") && ((isset($_REQUEST['search']) && $_REQUEST['search'] != ""))){
            $search = $_REQUEST['search'];
            // echo "1";

            $sql = "select * from ". $this->want_in_list." where fname like '%".$search."%' or email like '%".$search."%' ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->want_in_list." where fname like '%".$search."%' or email like '%".$search."%'";

        } else {
            $sql = "select * from ". $this->want_in_list." ORDER BY id ASC limit ".$start.",".$limit;
            $sql1 = "select * from ". $this->want_in_list;
        }
        
        $list = $this->common->fnCustomQuery($sql);
        $totalProducts = $this->common->fnCustomQuery($sql1);       

        $baseUrl = base_url().'want-in-list';
        $baseUrl .= ($this->uri->segment(4))?"/page/".$page:"";

        $totalPages = ceil(count($totalProducts)/$limit);
        $totalItems = count($totalProducts);

        $previous = $page - 1;
        $previous = ($previous == 0)?'disable':base_url().'want-in-list/page/'.$previous;

        $next = $page + 1;
        $next = ($next > $totalPages)?"disable":base_url().'want-in-list/page/'.$next;

        if(isset($_REQUEST['search'])) {
            $baseUrl .= '?search='.$_REQUEST['search'];
            
            if($next != "disable") {
                $next .= '?search='.$_REQUEST['search'];
            }

            if($previous != 'disable'){
                $previous .= '?search='.$_REQUEST['search'];
            }
        }

        $data = array(			
            'pageTitle' => 'I Want In Requests '.$this->site_name,
            'lists' => $list,
            'message' => $message,
            'start' => $start + 1,
            'baseUrl' => $baseUrl,
            'pagging' => array(
                'next'=> $next,
                'previous'=> $previous,
                'total_item'=> $totalItems,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'limit' => $limit
            )
        );

        $this->load->view('admin/Pages/want-in-list/index.php', $data);

    }

    private function removeFocusRequest($id) {

        try {

            $where = array('id'=>$id);
            $isThere = $this->common->fnGetWhere($this->focus_group_list,$where);

            if($isThere) {
                $this->common->fnDeleteWhere($this->focus_group_list,$where);
                $output = array(
                    'type'=>'error',
                    'message'=> "The Request removed successfully."
                );
            } else {
                $output = array(
                    'type'=>'error',
                    'message'=> "The Request is not available anymore."
                );
            }

        } catch(Exception $e) {
            $output = array(
                'type'=>'error',
                'message'=>$e->getMessage()
            );
        }

        return $output;
    }
    private function removePartnerRequest($id) {

        try {

            $where = array('id'=>$id);
            $isThere = $this->common->fnGetWhere($this->become_partner_list,$where);

            if($isThere) {
                $this->common->fnDeleteWhere($this->become_partner_list,$where);
                $output = array(
                    'type'=>'success',
                    'message'=> "The Request removed successfully."
                );
            } else {
                $output = array(
                    'type'=>'error',
                    'message'=> "The Request is not available anymore."
                );
            }

        } catch(Exception $e) {
            $output = array(
                'type'=>'error',
                'message'=>$e->getMessage()
            );
        }

        return $output;
    }
    private function removeWantInRequest($id) {

        try {

            $where = array('id'=>$id);
            $isThere = $this->common->fnGetWhere($this->want_in_list,$where);

            if($isThere) {
                $this->common->fnDeleteWhere($this->want_in_list,$where);
                $output = array(
                    'type'=>'error',
                    'message'=> "The Request removed successfully."
                );
            } else {
                $output = array(
                    'type'=>'error',
                    'message'=> "The Request is not available anymore."
                );
            }

        } catch(Exception $e) {
            $output = array(
                'type'=>'error',
                'message'=>$e->getMessage()
            );
        }

        return $output;
    }
        

    public function users() { 

        $page = ($this->uri->segment(4))?$this->uri->segment(4):1;

        $message = [];

        if(isset($_REQUEST['action']) && $_REQUEST['action']=='add-user') {
            $message = $this->add_user();
        }
        
        if(isset($_REQUEST['action']) && $_REQUEST['action']=='edit-user') {
            $message = $this->edit_user();
        }

        if(isset($_REQUEST['action']) && $_REQUEST['action']=='remove-user') {
            $message = $this->remove_user($_REQUEST['id']);
        }
        
        $limit = '10';                
        $start = ($page - 1 ) * $limit;                

        $sql = "select * from ". $this->users." ORDER BY id DESC limit ".$start.",".$limit;
        $users = $this->common->fnCustomQuery($sql);

        $baseUrl = base_url().'admin/users';
        $baseUrl .= ($this->uri->segment(4))?"/page/".$page:"";

        $data = array(			
            'pageTitle' => 'Users '.$this->site_name,
            'users' => $users,
            'message' => $message,
            'start' => $start + 1,
            'baseUrl' => $baseUrl,
        );

        $this->load->view('admin/Pages/Users.php', $data);

    }

    public function settings() {

        $message = "";

        if(isset($_POST['action']) && $_POST['action'] == "save_settings") {
            $message = $this->save_settings($_POST);
        }        

        $option_key = '"site_name","site_description","admin_email","youtube_id","countdown","stripe"';

        $sql = "select * from ".$this->settings." where option_key in (".$option_key.")";
        $settings = $this->common->fnCustomQuery($sql);        

        $tempSettings = array();

        if($settings) {
            
            for($i=0;$i<count($settings);$i++) {

                $key = $settings[$i]['option_key'];
                $value = $settings[$i]['option_value'];                
                
                if($settings[$i]['is_decoded'] == 'Yes') {
                    $base64_decode = base64_decode($value);
                    $tempValues = @unserialize($base64_decode);
                    $tempSettings[$key] = $tempValues;
                } else {
                    $tempSettings[$key] = $value;
                }
            }
            $settings = $tempSettings;
        }

        $data = array(			
            'pageTitle' => 'Settings '.$this->site_name,            
            'settings' => $settings,
            'message' => $message
        );

        $this->load->view('admin/Pages/Settings.php', $data);
    }

    private function save_settings() {

        try {

            $request = $_POST;
            $notToSave = array('action');

            foreach ($request as $key => $value) {

                if(!in_array($key,$notToSave)) {
                    if($key == 'affidavit_example_file' ) {
                        $this->saveAffidavitExample($_POST);
                    } else {
                        $where = array('option_key'=>$key);
                        $option = $this->common->fnGetWhere($this->settings,$where);

                        $tempValue = $value;

                        if(is_array($value)){
                            $value = base64_encode(serialize($value));
                        }

                        $dataToStore = array(
                            'option_key' => $key,
                            'option_value' => $value,
                        );

                        if(is_array($tempValue)){
                            $dataToStore['is_decoded'] = 'Yes';
                        }

                        if($option) {
                            $this->common->fnUpdateData($this->settings,$dataToStore,$where);
                        } else {
                            $dataToStore['time'] = time();
                            $this->common->fnInsertData($this->settings,$dataToStore);
                        }
                    }
                }

            }

            $output = array(
                'type' => 'success',
                'message' => "Settings are saved successfully."
            );

        } catch (Exception $e) {
            $output = array(
                'type' => 'error',
                'message' => $e->getMessage()
            );
        }

        return $output;
    }       

    // Save Notifications

    public function notifications() {  

        $message = "";
        
        if(isset($_REQUEST['action']) && $_REQUEST['action'] == "save_notifications") {
            $message = $this->save_notifications();
        }

        $notification_mails = $this->common->fnGetUnserializeOptions('notification_mails');

        $data = array(			
            'pageTitle' => 'Notifications'.$this->site_name,
            'message' => $message,
            'notification_mails' => $notification_mails
        );

        $this->load->view('admin/Pages/Notifications.php', $data);
    }

    private function save_notifications() {

        try {

            $request = $_POST;

            $where = array('option_key'=>'notification_mails');
            $notification_mails = $this->common->fnGetWhere($this->settings,$where);

            $mailData = array(
                'focus_group' => $request['focus_group'],
                'forgot_password' => $request['forgot_password'],
                'become_partners' => $request['become_partners'],
                'i_want_in' => $request['i_want_in'],
                'donate_now' => isset($request['donate_now'])?$request['donate_now']:"",
            );

            $mail_value = base64_encode(serialize($mailData));
            $data = array('option_key'=>'notification_mails','option_value'=>$mail_value);

            if($notification_mails) {
                $this->common->fnUpdateData($this->settings,$data,$where);
            } else {
                $this->common->fnInsertData($this->settings,$data);
            }

            $output = array(
                'type' => 'success',
                'message' => "Notifications are saved successfully."
            );

        } catch(Exception $e) {
            $output = array(
                'type' => 'error',
                'message' => $e->getMessage()
            );
        }

        return $output;

    }    
    
    public function add_user() {
        
        $requests = $_REQUEST;
        try {
            
            $params = ['name', 'email', 'password','user_type'];
            $checkResult = checkValuesPost($params);

            if($checkResult) {

                $user = $this->common->fnGetWhere($this->users,array('email' => $requests['email']));
                
                $user_type = ($requests['user_type'])?$requests['user_type']:"Normal";
                $status = ($requests['status'])?'Active':"Inactive";

                if(!$user) {

                    $userData = array(
                        'name' => $requests['name'],
                        'email' => $requests['email'],
                        'password' => md5($requests['password']),
                        'user_type' => $user_type,
                        'status' => $status,
                    );
                    
                    $newUser = $this->common->fnInsertData($this->users,$userData);                        
                    $user = $this->common->fnGetWhere($this->users,array('id' => $newUser));

                    if($newUser) {

                        $output = array(                
                            'type' => 'success',
                            'message' => 'New user created successfully!',
                            'user'=> $user[0],
                        );

                    }else{
                        $output = array(                
                            'type' => 'error',
                            'message' => 'Something went wrong. Please try again.',
                        );
                    }

                } else {
                    $output = array(                        
                        'type' => 'error',
                        'message' => 'Email is already registered.'
                    );
                }                

            }else{
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

    public function edit_user() {
        
        $requests = $_REQUEST;
        
        try {            
                    
            $user = $this->common->fnGetWhere($this->users,array('email' => $requests['edit_email']));
            
            if(!$user || $requests['id'] == $user[0]['id'] ) {

                $user_type = (isset($requests['user_type']))?$requests['user_type']:"Normal";
                $status = (isset($requests['status']))?'Active':"Inactive";

                $userData = array(
                    'name' => $requests['edit_name'],
                    'email' => $requests['edit_email'],                                                
                    'user_type' => $user_type,
                    'status' => $status,
                );

                if(isset($requests['edit_password']) && $requests['edit_password'] != "") {                    
                    $userData['password'] = md5($requests['edit_password']);
                }

                $this->common->fnUpdateData($this->users,$userData,array('id'=>$requests['id']));

                $output = array (
                    'type' => 'success',
                    'message' => 'User Edited successfully!'
                );

            } else {

                $output = array (
                    'type' => 'error',
                    'message' => 'Email is already in use.'
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

    private function remove_user($id) {

        try {
            $user = $this->common->fnGetWhere($this->users,array('id'=>$id));
            if($user) {

                $business = $this->common->fnGetWhere($this->business_table,array('user_id'=>$id));
                if($business){
                    foreach($business as $item){
                        $this->remove_business($item['id']);
                    }
                }

                $this->common->fnDeleteWhere($this->business_favorite,array('user_id'=>$id));
                $this->common->fnDeleteWhere($this->users,array('id'=>$id));

                $output = array(
                    'type' => 'success',
                    'message' => 'User removed successfully.'
                );

            } else {
                $output = array(
                    'type' => 'error',
                    'message' => 'User is not available.'
                );
            }

        } catch (Exception $e) {

            $output = array(
                'type' => 'error',
                'message' => $e->getMessage()
            );

        }

        return $output;
    }    
        
    /**
     * 
     */
    public function removeFile($file) {
        if(file_exists($file)) {
            @unlink($file);
        }
    } 

    public function verifyAdmin() {
        
        $acecessToken = $this->session->userdata('access_token');

        if($acecessToken) {
            global $user;
            $user = $this->verify_access_token($acecessToken);

            if($user['user_type'] != "Administrator") {
                $redirect = base_url();
                fn_redirect($redirect);
                exit;
            }
            
        } else {
            $redirect = base_url().'login';
            fn_redirect($redirect);
            exit;            
        }

    }    

}