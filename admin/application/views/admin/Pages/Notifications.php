<?php 
require_once(__DIR__.'/../header.php');
?>    

    <!-- Main Content -->
    <div id="content">

        <?php require_once(__DIR__.'/../top-bar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-5">

             <!-- Page Heading -->
            <div class="heading d-flex align-items-center justify-content-between">
                <h1 class="h3 mb-4 text-gray-800">Notifications</h1>
                <!-- <a class="add-new" href="#" data-toggle="modal" data-target="#add-user"><i class="fas fa-plus"></i> Add New</a> -->
            </div>

            <?php 
            if(isset($message['type'])) { 
                $type = (isset($message['type']) && $message['type'] == 'error')?"danger":$message['type'];
                ?>
                <div class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?php echo $message['message']; ?>
                </div>
            <?php                    
            }
            ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">&nbsp;</h6>
                </div>
                <div class="card-body">
                    <form id="add-notification" method="post" enctype="multipart/form-data">

                        <div class="verticle-tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="focus_group-tab" data-toggle="tab" href="#focus_group" role="tab" aria-controls="focus_group" aria-selected="true">Focus Group</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="become-partner-tab" data-toggle="tab" href="#become-partner" role="tab" aria-controls="become-partner" aria-selected="false">Become Partner</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="i-want-in-tab" data-toggle="tab" href="#i-want-in" role="tab" aria-controls="i-want-in" aria-selected="false">I want In</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="donate_now-tab" data-toggle="tab" href="#donate_now" role="tab" aria-controls="donate_now" aria-selected="false">Donate Now</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="forgot-password-tab" data-toggle="tab" href="#forgot-password" role="tab" aria-controls="forgot-password" aria-selected="false">Forgot-Password</a>
                                </li>
                              
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="focus_group" role="tabpanel" aria-labelledby="focus_group-tab">
                                    
                                    <?php 
                                        $admin_subject = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['admin']['subject'])?$notification_mails['focus_group']['admin']['subject']:"";
                                        $admin_content = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['admin']['content'])?$notification_mails['focus_group']['admin']['content']:"";
                                
                                        $user_subject = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['user']['subject'])?$notification_mails['focus_group']['user']['subject']:"";
                                        $user_content = (isset($notification_mails['focus_group']) && $notification_mails['focus_group']['user']['content'])?$notification_mails['focus_group']['user']['content']:"";
                                    ?>
                                    <div class="pt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">Admin Notification</h6>                                   
                                        
                                        <div class="form-group">                                    
                                            <input name="focus_group[admin][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $admin_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="focus_group[admin][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $admin_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                            </p>
                                        </div>
                                    </div>
                                
                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">User Notification</h6>
                                                                            
                                        <div class="form-group">                                    
                                            <input name="focus_group[user][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $user_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="focus_group[user][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $user_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>                               

                                <div class="tab-pane fade show" id="become-partner" role="tabpanel" aria-labelledby="become-partner-tab">

                                    <?php 
                                        $admin_subject = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['admin']['subject'])?$notification_mails['become_partners']['admin']['subject']:"";
                                        $admin_content = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['admin']['content'])?$notification_mails['become_partners']['admin']['content']:"";
                                
                                        $user_subject = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['user']['subject'])?$notification_mails['become_partners']['user']['subject']:"";
                                        $user_content = (isset($notification_mails['become_partners']) && $notification_mails['become_partners']['user']['content'])?$notification_mails['become_partners']['user']['content']:"";
                                    ?>

                                    <div class="pt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">Admin Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="become_partners[admin][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $admin_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="become_partners[admin][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $admin_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                                [parnership_offering] : Partnership Offering <br/>
                                                [additional_info] : Additional Comments <br/>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">User Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="become_partners[user][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $user_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="become_partners[user][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $user_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                                [parnership_offering] : Partnership Offering <br/>
                                                [additional_info] : Additional Comments <br/>
                                            </p>
                                        </div>
                                    </div>

                                </div> 

                                <div class="tab-pane fade show" id="i-want-in" role="tabpanel" aria-labelledby="i-want-in-tab">

                                    <?php
                                        $admin_subject = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['admin']['subject'])?$notification_mails['i_want_in']['admin']['subject']:"";
                                        $admin_content = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['admin']['content'])?$notification_mails['i_want_in']['admin']['content']:"";

                                        $user_subject = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['user']['subject'])?$notification_mails['i_want_in']['user']['subject']:"";
                                        $user_content = (isset($notification_mails['i_want_in']) && $notification_mails['i_want_in']['user']['content'])?$notification_mails['i_want_in']['user']['content']:"";
                                    ?>

                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">Admin Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="i_want_in[admin][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $admin_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="i_want_in[admin][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $admin_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">User Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="i_want_in[user][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $user_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="i_want_in[user][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $user_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Phone] : Phone of User <br/>
                                                [Social_plateform] : Social Plateform of User <br/>
                                                [handle_url] : Handle or URL of User <br/>
                                            </p>
                                        </div>
                                    </div>

                                </div>   

                                <div class="tab-pane fade show" id="donate_now" role="tabpanel" aria-labelledby="donate_now-tab">

                                    <?php
                                        $admin_subject = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['admin']['subject'])?$notification_mails['donate_now']['admin']['subject']:"";
                                        $admin_content = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['admin']['content'])?$notification_mails['donate_now']['admin']['content']:"";

                                        $user_subject = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['user']['subject'])?$notification_mails['donate_now']['user']['subject']:"";
                                        $user_content = (isset($notification_mails['donate_now']) && $notification_mails['donate_now']['user']['content'])?$notification_mails['donate_now']['user']['content']:"";
                                    ?>

                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">Admin Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="donate_now[admin][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $admin_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="donate_now[admin][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $admin_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Amount] : Donation Amount <br/>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">User Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="donate_now[user][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $user_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="donate_now[user][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $user_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>
                                                [Amount] : Donation Amount <br/>
                                                
                                            </p>
                                        </div>
                                    </div>

                                </div>                               
                                
                                <div class="tab-pane fade show" id="forgot-password" role="tabpanel" aria-labelledby="forgot-password-tab">

                                    <?php
                                        $user_subject = (isset($notification_mails['forgot_password']) && $notification_mails['forgot_password']['user']['subject'])?$notification_mails['forgot_password']['user']['subject']:"";
                                        $user_content = (isset($notification_mails['forgot_password']) && $notification_mails['forgot_password']['user']['content'])?$notification_mails['forgot_password']['user']['content']:"";
                                    ?>
                                    
                                    <div class="mt-3">
                                        <h6 class="mb-3 font-weight-bold text-primary">User Notification</h6>
                                        
                                        <div class="form-group">                                    
                                            <input name="forgot_password[user][subject]" type="text" class="form-control form-control-user required" placeholder="Subject" value="<?php echo $user_subject; ?>">
                                        </div>
                                        <div class="form-group mb-0">       
                                            <textarea name="forgot_password[user][content]" rows="8" class="form-control tinymceEditor form-control-user required" placeholder="Mail Text"><?php echo $user_content; ?></textarea>
                                            <p class="mt-2 mb-0 small">
                                                [Name] : Name of User <br/>
                                                [Email] : Email of User <br/>                                                
                                                [Password_link] : Updating Password Link <br/>                                                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                                        
                            </div>
                        </div>

                        <hr class="sidebar-divider">

                        <div class="form-group">                            
                            <input type="hidden" name="action" value="save_notifications">                            
                            <input type="submit" class="btn btn-primary" value="Save">
                        </div>
                    </form>
                </div>                

            </div>           
           

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php
require_once(__DIR__.'/../footer.php');