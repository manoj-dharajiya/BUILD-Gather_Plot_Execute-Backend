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
                <h1 class="h3 mb-4 text-gray-800">Settings</h1>
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
                    <form id="add-logo" method="post" enctype="multipart/form-data">
                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="stripe-keys-tab" data-toggle="tab" href="#stripe-keys" role="tab" aria-controls="stripe-keys" aria-selected="false">Stripe Credentials</a>
                            </li>                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="countdown-date-tab" data-toggle="tab" href="#countdown-date" role="tab" aria-controls="countdown-date" aria-selected="false">Countdown Date</a>
                            </li>                            
                            
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="pt-3">
                                    <h6 class="mb-3 font-weight-bold text-primary">General Settings</h6>
                                    
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input name="site_name" type="text" class="form-control form-control-user required" placeholder="" value="<?php echo (isset($settings['site_name']))?$settings['site_name']:""; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Tagline</label>
                                        <input name="site_description" type="text" class="form-control form-control-user required" placeholder="" value="<?php echo (isset($settings['site_description']))?$settings['site_description']:""; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Administration Email Address</label>
                                        <input name="admin_email" type="text" class="form-control form-control-user required" placeholder="" value="<?php echo (isset($settings['admin_email']))?$settings['admin_email']:""; ?>">
                                    </div>
                                    
                                    <div class="form-group mb-0">
                                        <label>Popup Video ID</label>
                                        <input name="youtube_id" type="text" class="form-control form-control-user required" placeholder="" value="<?php echo (isset($settings['youtube_id']))?$settings['youtube_id']:""; ?>">
                                        <span class="small">Youtube Video ID eg: aqz-KE-bpKQ</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="stripe-keys" role="tabpanel" aria-labelledby="stripe-keys-tab">
                                <div class="pt-3">
                                    <h6 class="mb-3 font-weight-bold text-primary">Access Keys</h6>

                                    <div class="form-group">
                                        <label>Publishable key</label>
                                        <input name="stripe[pk_key]" type="text" class="form-control form-control-user owner_name required" value="<?php echo (isset($settings['stripe']['pk_key']))?$settings['stripe']['pk_key']:""; ?>"> <br/>
                                    </div>                             
                                    <div class="form-group">
                                        <label>Secret key</label>
                                        <input name="stripe[sk_key]" type="text" placeholder="" class="form-control form-control-user owner_name required" value="<?php echo (isset($settings['stripe']['sk_key']))?$settings['stripe']['sk_key']:""; ?>"> <br/>
                                    </div>                             

                                </div>
                            </div>
                            <div class="tab-pane fade show" id="countdown-date" role="tabpanel" aria-labelledby="countdown-date-tab">
                                <div class="pt-3">
                                    <h6 class="mb-3 font-weight-bold text-primary">Select Date / Time</h6>

                                    <div class="form-group">
                                        <label>Date </label>
                                        <input name="countdown[date]" type="date" class="form-control form-control-user owner_name required" value="<?php echo (isset($settings['countdown']['date']))?$settings['countdown']['date']:""; ?>"> <br/>
                                    </div>                             
                                    <div class="form-group">
                                        <label>Time (hh:mm:ss) </label>
                                        <input name="countdown[time]" type="time" placeholder="hh:mm:ss" class="form-control form-control-user owner_name required" value="<?php echo (isset($settings['countdown']['time']))?$settings['countdown']['time']:""; ?>"> <br/>
                                    </div>                             

                                </div>
                            </div>
                            <div class="tab-pane fade show" id="certificate-reminder" role="tabpanel" aria-labelledby="certificate-reminder-tab">
                                <div class="pt-3">
                                    <h6 class="mb-3 font-weight-bold text-primary">Reminder Time</h6>

                                    <div class="form-group">
                                        <label>Max Notification</label>
                                        <input name="max_notifications" type="text" class="form-control form-control-user required" placeholder="" value="<?php echo (isset($settings['max_notifications']))?$settings['max_notifications']:""; ?>">
                                    </div>

                                    <div class="form-group mb-0">
                                        <label>Select Reminder Time </label>
                                        <select name="certificate_verification_reminder" class="form-control form-control-user required">
                                            <option value="">Select</option>
                                            <option <?php echo (isset($settings['certificate_verification_reminder']) && $settings['certificate_verification_reminder']=='hourly')?'selected="selected"':''; ?> value="hourly">Hourly</option>
                                            <option <?php echo (isset($settings['certificate_verification_reminder']) && $settings['certificate_verification_reminder']=='daily')?'selected="selected"':''; ?> value="daily">Daily</option>
                                            <option <?php echo (isset($settings['certificate_verification_reminder']) && $settings['certificate_verification_reminder']=='2-days')?'selected="selected"':''; ?> value="2-days">Every 2 Days</option>
                                            <option <?php echo (isset($settings['certificate_verification_reminder']) && $settings['certificate_verification_reminder']=='3-days')?'selected="selected"':''; ?> value="3-days">Every 3 Days</option>
                                        </select>                                        
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr class="sidebar-divider">

                        <div class="form-group">                            
                            <input type="hidden" name="action" value="save_settings">                            
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