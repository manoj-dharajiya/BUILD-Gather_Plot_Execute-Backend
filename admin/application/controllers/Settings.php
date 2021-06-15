<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(__DIR__.'/Auth.php');

class Settings extends Auth {
    private $site_options = 'site_options';

    function __construct() {
        parent::__construct();
    }

    public function admin_save_settings() {

        $requests = $_REQUEST;       

        try {

            @$is_admin = $this->verify_admin();
            
            if($is_admin){

                $settings = $this->common->fnGetWhere($this->site_options,array('option_key'=>'settings'));
                
                if($settings) {
                    $data = array(
                        'option_value' => serialize($requests)
                    );
                    $this->common->fnUpdateData($this->site_options,$data,array('option_key'=>'settings'));
                } else {
                    $data = array(
                        'option_key' => 'settings',
                        'option_value' => serialize($requests)
                    );
                    $this->common->fnInsertData($this->site_options,$data);
                }
                
                $settings = $this->common->fnGetWhere($this->site_options,array('option_key'=>'settings'));
                $settings = unserialize($settings[0]['option_value']);

                $output = array(
                    'type' => 'success',
                    'message' => "Settings saved successfully",
                    'settings' => $settings
                );
            } else {
                $output = array(                
                    'type' => 'error',
                    'message' => 'You are not allow to perform this task.',
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
    public function admin_get_settings() {
        
        try {            
            
            $settings = $this->common->fnGetWhere($this->site_options,array('option_key'=>'settings'));
            $settings = unserialize($settings[0]['option_value']);

            $output = array(
                'type' => 'success',
                'message' => "Settings saved successfully",
                'settings' => $settings
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
    
    public function upload_logo() {

        $requests = $_POST;       

        try {

            $is_admin = $this->verify_admin();   
            
            // pre($_FILES);
            $imageFile = $_FILES;
            
            // if($is_admin) {

                $oldLogo = $this->common->fnGetWhere($this->site_options,array('option_key'=>'site_logo'));

                $rootPath = ROOT_PATH . '/uploads/';                
                $imageName = 'uploads/bbd_logo_img_'.time().'.png';
                $imagePath = ROOT_PATH .'/'. $imageName;

                if($oldLogo[0]['option_value'] != ""){

                    $oldLogoPath = ROOT_PATH .'/'. $oldLogo[0]['option_value'];

                    if(file_exists($oldLogoPath)){
                        @unlink($oldLogoPath);
                    }
                }
                @move_uploaded_file($imageFile['image']['tmp_name'],$imagePath);
                
                if($oldLogo) {
                    $data = array(
                        'option_value' => $imageName
                    );
                    $this->common->fnUpdateData($this->site_options,$data,array('option_key'=>'site_logo'));
                } else {
                    $data = array(
                        'option_key' => 'site_logo',
                        'option_value' => $imageName
                    );
                    $this->common->fnInsertData($this->site_options,$data);
                }

                $image = '<img id="preview-image" src="'.base_url().$imageName.'" alt="" />';


                $output = array(
                    'type' => 'success',
                    'message' => 'Logo Updated successfully!',
                    'image' => $image
                );

            // } else {
            //     $output = array(                
            //         'type' => 'error',
            //         'message' => 'You are not allow to perform this task.',
            //     );
            // }

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
}