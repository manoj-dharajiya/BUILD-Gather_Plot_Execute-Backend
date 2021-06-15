<?php 
require_once('header.php');

$searchTerm = (isset($_REQUEST['search']))?$_REQUEST['search']:"";

?>  
    <script>var business = []; </script>
    <div class="container">
        <?php 
        if(isset($message) && $message != "") { 
            $type = ($message['type'] == 'error')?"danger":$message['type'];
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
        // pr($business);
        // pr($user);
              
        if($user && $business && ($user[0]['user_type'] == 'Administrator' || $business['user_id'] == $user[0]['id'])) {

			$business_logo = ($business['business_logo'])?base_url().'/'.$business['business_logo']:"";
			$business_dba = (isset($business['business_dba']))?$business['business_dba']:"";

        ?>
            <div class="heading">
                <h1>Edit My Business </h1>
            </div>
            <form id="edit-bussiness" action="<?php echo base_url();?>/update-my-business/" method="post" enctype="multipart/form-data">
            
                <div class="owner card">

                    <div class="card-title-wrapper">
                        <h2>Business Details</h2>
                        <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Legal Business Name <span class="required-field">*</span></label>
                                <input id="name" name="name" type="text" class="form-control form-control-user required" placeholder="Legal Business Name" value="<?php echo $business['business_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Doing Business As (DBA)</label>
                                <input id="dba" name="dba" type="text" class="form-control form-control-user required" placeholder="DBA" value="<?php echo $business_dba; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <?php // pr($business_fields); ?>	  

                    <div class="row align-items-center">
                        <?php							
                            $primary_category1 = (isset($business['primary_category']))?$business['primary_category']:"";
                            $secondary_category1 = (isset($business['secondary_category']))?$business['secondary_category']:"";
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <label>Business Category</label>
                            <div class="form-group">                
                                <select id="primary_category" name="primary_category" class="form-control form-control-user custom-select required">
                                <option value="">Business Category</option>
                                <?php
                                if($primary_category) {
                                    for($i=0;$i<count($primary_category);$i++) {
                                    ?>      
                                    <option <?php echo ($primary_category1 == $primary_category[$i]['id'])?'selected="selected"':'' ?> value="<?php echo $primary_category[$i]['id']?>"><?php echo $primary_category[$i]['name']?></option>
                                    <?php }
                                }?>                  
                                </select>
                            </div>
                        </div>       

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <?php
                                $address = unserialize($business['business_address']);
                            ?>

                            <div class="form-group">
                                <label>Website</label>
                                <input id="website" name="website" type="text" class="form-control form-control-user" placeholder="Website" value="<?php echo $address['website']; ?>">
                            </div>
                        </div>

                    </div>

                    <div class="row align-items-center">					
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input id="address" name="address" type="text" class="form-control form-control-user required" placeholder="Address" value="<?php echo $address['address']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>City</label>
                                <input id="city" name="city" type="text" class="form-control form-control-user required" placeholder="City" value="<?php echo $address['city']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>State</label>
                                    <select name="state" class="form-control required form-control-user custom-select">
                                        <option value="">Select State</option>
                                        <?php foreach($states as $state){ ?>
                                        <option <?php if($address['state'] == $state){ echo 'selected="selected"';}?> value="<?php echo $state; ?>"><?php echo $state; ?></option>                    
                                        <?php } ?>
                                    </select>				  
                                <!-- <input id="state" name="state" type="text" class="form-control form-control-user required" placeholder="State" value="<?php echo $address['state']; ?>"> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Zip Code</label>
                                <input id="zipcode" name="zipcode" type="text" class="form-control form-control-user required" placeholder="Zip Code" value="<?php echo $address['zipcode']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                            $isChecked = (isset($address['is_address_hidden']) && $address['is_address_hidden']=='yes')?"checked='checked'":"";
                            ?>
                            <div class="form-group">                                        
                                <label><input type="checkbox" name="is_address_hidden" value="yes" <?php echo $isChecked;?>> Hide my street address.</label>
                            </div>
                        </div>

                    </div>

                    
                    <div class="row align-items-center">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Business Phone</label>
                                <input id="phone" name="phone" type="text" class="form-control form-control-user phone-number-change required" placeholder="(XXX) XXX-XXXX" value="<?php echo $business['business_phone']; ?>">			
                            </div>
                            
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Business Email</label>
                                <input id="email" name="email" type="email" class="form-control form-control-user required" placeholder="Email Address" value="<?php echo $business['business_email']; ?>">
                            </div>
                        </div>
                        
                    </div>				

                    <div class="form-group">
                        <label>Company Info</label>
                        <textarea name="business_desc" class="form-control form-control-user admin-notes"><?php echo trim($business['business_desc']); ?></textarea>                                      
                    </div>

                    <div class="form-group">
                        <label>Business Logo</label>
                        <div class="row align-items-center">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" id="upload_image" name="business_logo" class="form-control form-control-user">						
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="business_logo_image">  
                                    <?php if($business_logo){?>
                                    <span class="remove-img"><i class="fas fa-times"></i></span>       
                                    <input type="hidden" id="remove_business_logo" name="remove_business_logo" value="">
                                    <?php } ?>
                                    <img id="preview-image" src="<?php echo $business_logo; ?>" alt="" />
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                
                <div id="business-certificate-wrapper-1">
                    <div class="card owner light-gray-card">

                        <div class="card-title-wrapper">
                            <h2>Black-Owned Verification Method</h2>						
                        </div>

                        <?php 				
                        // pr($business_fields['black_owned_certificates']);	
                        if(isset($business_fields['black_owned_certificates'])){
                            $black_owned_certificates = (isset($business_fields['black_owned_certificates']['black_owned_certificates']) && $business_fields['black_owned_certificates']['black_owned_certificates'] !="")?$business_fields['black_owned_certificates']['black_owned_certificates']:"";
                            $black_owned_certificates_id = (isset($business_fields['black_owned_certificates']['black_owned_certificates_id']) && $business_fields['black_owned_certificates']['black_owned_certificates_id'] !="")?$business_fields['black_owned_certificates']['black_owned_certificates_id']:"";
                            $black_owned_certificates_file = (isset($business_fields['black_owned_certificates']['black_owned_certificates_file']) && $business_fields['black_owned_certificates']['black_owned_certificates_file'] !="")?$business_fields['black_owned_certificates']['black_owned_certificates_file']:"";
                        } else {
                            $black_owned_certificates = "";
                            $black_owned_certificates_id = "";
                            $black_owned_certificates_file = "";
                        }
                        ?>

                        <div class="card-inside">
                        
                            <div class="row align-items-center">              
                                <div class="col-md-12 col-sm-12 col-12">

                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label>Choose a way to verify below. <span class="required-field">*</span></label>
                                                <select id="business_certificates" name="black_owned_certificates" class="form-control form-control-user required business_certificates custom-select">
                                                    <option value="">Select Verification Type</option>
                                                    <option <?php if($black_owned_certificates == "MD MBE"){ echo 'selected="selected"'; }?> value="MD MBE">MD MBE</option>
                                                    <option <?php if($black_owned_certificates == "Other MBE"){ echo 'selected="selected"'; }?> value="Other MBE">Other MBE</option>
                                                    <option <?php if($black_owned_certificates == "Affidavit"){ echo 'selected="selected"'; }?> value="Affidavit">Affidavit</option>
                                                    <option <?php if($black_owned_certificates == "Third Party Certification"){ echo 'selected="selected"'; }?> value="Third Party Certification">Third Party Certification</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php 
                                        $show_certificates_id = ($black_owned_certificates != "Affidavit" && $black_owned_certificates !='')?'show':"";
                                        $show_download_template = ($black_owned_certificates == "Affidavit" && $black_owned_certificates !='')?'show':"";
                                        ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="affidavit_example_file text-right <?php echo $show_download_template; ?>">
                                                <a href="<?php echo base_url().$settings[0]['option_value'];?>" target="_blank">Download Affidavit Template</a>
                                            </div>
                                            <div id="business_certificates_id" class="business_certificates_id <?php echo $show_certificates_id; ?>">
                                                <div class="form-group">
                                                    <label>Certificate ID <span class="required-field">*</span></label>
                                                    <input type="text" name="black_owned_certificates_id" class="form-control form-control-user required" placeholder="Certificate ID" value="<?php echo $black_owned_certificates_id;?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <?php $show_certificates_attachment = ($black_owned_certificates == "Affidavit")?'show':""; ?>
                                        <!-- <div id="business_certificates_attachment" class="<?php echo $show_certificates_attachment;?>"> -->
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Attachment <span class="required-field">*</span></label>
                                            </div>
                                            <?php $hideClass = ($black_owned_certificates_file !="")?"hide-attachment":""; ?>
                                            <div class="col-md-12 col-sm-12 col-xs-12 attachment-file <?php echo $hideClass; ?>">								
                                                <div class="form-group">										
                                                    <input type="file" name="black_owned_certificates_file" class="form-control form-control-user">										
                                                </div>
                                            </div>
                                            <?php if($black_owned_certificates_file != ''){ ?>
                                                <div class="col-md-10 col-sm-9 col-xs-8">
                                                    <div class="form-group">										
                                                        File : <a href="<?php echo base_url().$black_owned_certificates_file ?>" target="_blank"><?php echo base_url().$black_owned_certificates_file ?></a>										
                                                    </div>
                                                <!-- </div>
                                                <div class="col-md-2 col-sm-3 col-xs-4 text-right">
                                                    <div class="form-group">
                                                        <span class="action-btn btn btn-sm btn-secondary btn-circle edit-attachment"><i class="fas fa-pencil-alt"></i></span>
                                                    </div>
                                                </div> -->
                                            <?php } ?>
                                        <!-- </div> -->
                                    </div>

                                </div>                                        
                            </div>

                        </div>

                    </div>
                </div>			

                <div class="owners-details">
                
                    <div id="owners-details-wrapper">
                        
                        <?php 
                        $owners = unserialize($business['business_owners']);	
                        $inc = 0;
                        if($owners) {
                            foreach($owners as $owner){
                                $ownerName = explode(' ', $owner['owner_name']);
                                $first_name = ($ownerName[0])?$ownerName[0]:"";
                                $last_name = "";
                                for($i=1;$i<count($ownerName);$i++){
                                    $last_name .= ($ownerName[$i])?$ownerName[$i].' ':"";
                                }
                                
                            ?>
                            <div class="owner card">

                                <?php if($inc ==  0) { ?>

                                    <div class="card-title-wrapper">
                                        <h2>Owner Details</h2>
                                        <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                                    </div>
                                <?php } $inc++; ?>
                                
                                <div class="card-inside">

                                    <div class="row align-items-center">
                                        <div class="col-md-10 col-10">

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group" data-fullname="<?php echo $owner['owner_name']; ?>">
                                                    <label>Owner First Name <span class="required-field">*</span></label>
                                                    <input name="owner_first_name[]" type="text" class="form-control form-control-user owner_first_name required" placeholder="Owner First Name" value="<?php echo $first_name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                    <label>Owner Last Name <span class="required-field">*</span></label>
                                                    <input name="owner_last_name[]" type="text" class="form-control form-control-user owner_last_name required" placeholder="Owner Last Name" value="<?php echo $last_name; ?>">
                                                    </div>
                                                </div>
                                            
                                            </div>

                                            <div class="row">
                                                <?php $email = (isset($owner['owner_email']))?$owner['owner_email']:""; ?>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                    <label>Owner Email <span class="required-field">*</span></label>
                                                    <input name="owner_email[]" type="email" class="form-control form-control-user owner_email required" placeholder="Owner Email" value="<?php echo $email; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php $phone = (isset($owner['owner_phone']))?$owner['owner_phone']:""; ?>
                                                    <div class="form-group">
                                                    <label>Owner Phone <span class="required-field">*</span></label>
                                                    <input name="owner_phone[]" type="text" class="form-control form-control-user owner_phone phone-number-change required" placeholder="(XXX) XXX-XXXX" value="<?php echo $phone; ?>">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Race <span class="required-field">*</span></label>
                                                        <select name="owner_race[]" class="form-control required form-control-user custom-select">
                                                            <option value="">Select Race</option>
                                                            <option <?php if(isset($owner['owner_race']) && $owner['owner_race'] == "Black"){ echo "selected='selected'"; } ?> value="Black">Black</option>
                                                            <option <?php if(isset($owner['owner_race']) && $owner['owner_race'] == "Other"){ echo "selected='selected'"; } ?> value="Other">Other</option>
                                                        </select>
                                                        <!-- <input name="owner_race[]" type="text" class="form-control form-control-user required" placeholder="Race" value="<?php echo $owner['owner_race']; ?>"> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?php $percentage = (isset($owner['percentage']))?$owner['percentage']:""; ?>
                                                    <div class="form-group">
                                                        <label>Ownership Percentage <span class="required-field">*</span></label>
                                                        <input name="percentage[]" type="text" class="form-control form-control-user required" placeholder="Ownership Percentage" value="<?php echo $percentage; ?>">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                    <input name="ownership[]" type="text" class="form-control form-control-user required" placeholder="Ownership" value="<?php echo $owner['ownership']; ?>">
                                                    </div>
                                                </div> -->
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-2 col-2 text-center">
                                            <div class="action-btns">
                                                <!-- <span class="fill-poc-value btn btn-secondary ">Set as POC</span> <br/> <br/> -->
                                                <span class="action-btn add-owner btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                                <span class="action-btn remove-owner btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-12">
                                            <div class="action-btns">
                                                <br/> <span class="fill-poc-value btn btn-success ">Set as POC</span>  <br/><br/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <?php } 
                        } else {
                            ?>
                            <div class="owner card">							

                                <div class="card-title-wrapper">
                                    <h2>Owner Details</h2>
                                    <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                                </div>

                                <div class="card-inside">

                                    <div class="row align-items-center">
                                        <div class="col-md-10 col-10">

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Owner First Name <span class="required-field">*</span></label>
                                                        <input name="owner_first_name[]" type="text" class="form-control form-control-user owner_first_name required" placeholder="Owner First Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Owner Last Name <span class="required-field">*</span></label>
                                                        <input name="owner_last_name[]" type="text" class="form-control form-control-user owner_last_name required" placeholder="Owner Last Name">
                                                    </div>
                                                </div>                                                    
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                
                                                    <div class="form-group">
                                                        <label>Owner Email <span class="required-field">*</span></label>
                                                        <input name="owner_email[]" type="email" class="form-control form-control-user owner_email required" placeholder="Owner Email">
                                                        <span class="errMsg"></span>
                                                    </div>
                                                
                                                    
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Owner Phone <span class="required-field">*</span></label>
                                                        <input name="owner_phone[]" type="text" class="form-control form-control-user owner_phone phone-number-change required" placeholder="(XXX) XXX-XXXX">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Race <span class="required-field">*</span></label>
                                                        <select name="owner_race[]" class="form-control required form-control-user custom-select">
                                                            <option value="">Race</option>
                                                            <option value="Black">Black</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <!-- <input name="owner_race[]" type="text" class="form-control form-control-user required" placeholder="Race"> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                    <label>Ownership Percentage <span class="required-field">*</span></label>
                                                    <input name="percentage[]" type="text" class="form-control form-control-user required" placeholder="Ownership Percentage">
                                                    </div>
                                                </div>                      
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-2 col-2 text-center">
                                            <div class="action-btns">
                                                <!-- <span class="fill-poc-value btn btn-secondary ">Set as POC</span> <br/> <br/> -->
                                                <span class="action-btn add-owner btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                                <span class="action-btn remove-owner btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-12">
                                            <div class="action-btns">
                                                <span class="fill-poc-value btn btn-success ">Set as POC</span> <br/> <br/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } ?>

                    </div>

                </div>
            
                <?php
                $primary_poc_first_name = (isset($business_fields['primary_poc_first_name']))?$business_fields['primary_poc_first_name']:"";
                $primary_poc_last_name = (isset($business_fields['primary_poc_last_name']))?$business_fields['primary_poc_last_name']:"";

                if($primary_poc_first_name == "" && $primary_poc_last_name == "") {
                    if(isset($business_fields['primary_poc_name'])) {
                        $primary_poc_name = explode(' ',$business_fields['primary_poc_name']);
                        $primary_poc_first_name = $primary_poc_name[0];
                        $primary_poc_last_name = "";
                        for($i=1;$i<count($primary_poc_name);$i++) {
                            $primary_poc_last_name .= ($primary_poc_name[$i])?$primary_poc_name[$i].' ':"";
                        }
                    }
                }
                
                $primary_poc_email = (isset($business_fields['primary_poc_email']))?$business_fields['primary_poc_email']:"";
                $primary_poc_phone = (isset($business_fields['primary_poc_phone']))?$business_fields['primary_poc_phone']:"";

                ?>
                <div class="card owner light-gray-card">

                    <div class="card-title-wrapper extra-space">
                        <h2>Primary POC</h2>
                        <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3>                    
                    </div>
                    
                    <div class="card-inside">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Primary POC First Name <span class="required-field">*</span></label>
                                    <input id="primary_poc_first_name" name="primary_poc_first_name" type="text" class="form-control form-control-user required" placeholder="Primary POC First Name" value="<?php echo $primary_poc_first_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Primary POC Last Name <span class="required-field">*</span></label>
                                    <input id="primary_poc_last_name" name="primary_poc_last_name" type="text" class="form-control form-control-user required" placeholder="Primary POC Last Name" value="<?php echo $primary_poc_last_name; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Primary POC Email</label>
                                    <input id="primary_poc_email" name="primary_poc_email" type="email" class="form-control form-control-user" placeholder="Primary POC Email" value="<?php echo $primary_poc_email; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Primary POC Phone</label>
                                    <input id="primary_poc_phone" name="primary_poc_phone" type="text" class="form-control phone-number-change form-control-user" placeholder="(XXX) XXX-XXXX" value="<?php echo $primary_poc_phone; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            

                <div id="social-wrapper">               
                        
                    <?php 
                    $social_medias = (isset($business_fields['social_media']))?unserialize($business_fields['social_media']):"";
                    if($social_medias) {
                        $inc = 0;
                        foreach($social_medias as $media){
                            ?>
                            <div class="card owner">

                                <?php if($inc ==  0) { ?>

                                <div class="card-title-wrapper">
                                    <h2>Social Media</h2>
                                    <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                                </div>
                                
                                <?php } $inc++; ?>

                                <div class="card-inside">

                                    <div class="row align-items-center">              
                                        <div class="col-md-10 col-sm-10 col-10">
                                            <div class="row align-items-center">

                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Social Medial</label>
                                                        <select id="social_media" name="social_media[]" class="form-control form-control-user custom-select">
                                                            <option value="">Social Medial</option>
                                                            <option <?php echo ($media['social_media'] == 'facebook')?'selected="selected"':'' ?> value="facebook">Facebook</option>
                                                            <option <?php echo ($media['social_media'] == 'instagram')?'selected="selected"':'' ?> value="instagram">Instagram</option>
                                                            <option <?php echo ($media['social_media'] == 'twitter')?'selected="selected"':'' ?> value="twitter">Twitter</option>
                                                            <option <?php echo ($media['social_media'] == 'linkedin')?'selected="selected"':'' ?> value="linkedin">LinkedIn</option>
                                                            <option <?php echo ($media['social_media'] == 'youtube')?'selected="selected"':'' ?> value="youtube">YouTube</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Social Link</label>
                                                        <input type="text" name="social_link[]" class="form-control form-control-user" placeholder="Link" value="<?php echo $media['social_link']; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-2 text-center">
                                            <div class="action-btns">
                                                <span class="action-btn add-social-media btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                                <span class="action-btn remove-social-media btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }				
                    } else {
                        ?>
                        <div class="card owner">

                            <div class="card-title-wrapper">
                                <h2>Social Media</h2>
                                <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                            </div>

                            <div class="card-inside">

                                <div class="row align-items-center">              
                                    <div class="col-md-10 col-sm-10 col-10">
                                        <div class="row align-items-center">

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Social Media</label>
                                                    <select name="social_media[]" class="form-control form-control-user custom-select">
                                                        <option value="">Social Media</option>
                                                        <option value="facebook">Facebook</option>
                                                        <option value="instagram">Instagram</option>
                                                        <option value="twitter">Twitter</option>
                                                        <option value="linkedin">LinkedIn</option>
                                                        <option value="youtube">Youtube</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Social Link</label>
                                                    <input type="text" name="social_link[]" class="form-control form-control-user"  placeholder="Link">                      
                                                </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-2 text-center">
                                        <div class="action-btns">
                                            <span class="action-btn add-social-media btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                            <span class="action-btn remove-social-media btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <?php
                    }
                    ?>            
                </div>
                
                <div id="business-certificate-wrapper">
                    <?php
                    if($business_certificates) {

                        // pre($business_certificates);
                        $inc = 0;
                        foreach($business_certificates as $cerificate) {

                            $otherVisible = ($cerificate['certificate_name'] == "other")?"other-show":"";
                            $business_certificates_id = (isset($cerificate['certificate_id']))?$cerificate['certificate_id']:"";
                            ?>			
                            <div class="card owner light-gray-card">
                                
                                <?php if($inc ==  0) { ?>
                                <div class="card-title-wrapper">
                                    <h2>Other Business Certificates</h2>
                                    <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                                </div>
                                <?php } $inc++; ?>

                                <div class="card-inside">
                                
                                    <div class="row align-items-center">              
                                        <div class="col-md-10 col-sm-10 col-10">

                                            <input type="hidden" name="admin_business_certificates_id[]" value="<?php echo $cerificate['id'] ?>"> 

                                            <div class="row align-items-center">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Business Certificate</label>
                                                        <select name="business_certificates[]" class="form-control form-control-user business_certificates custom-select">
                                                            <option value="">Select Business Certificate</option>												
                                                            <option <?php echo ($cerificate['certificate_name'] == "Women Owned")?'selected="selected"':""; ?> value="Women Owned">Women Owned</option>
                                                            <option <?php echo ($cerificate['certificate_name'] == "Veteran Owned")?'selected="selected"':""; ?> value="Veteran Owned">Veteran Owned</option>										
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Business Certificates ID</label>
                                                        <input type="text" name="business_certificates_id[]" class="form-control form-control-user" placeholder="Business Certificate ID" value="<?php echo $business_certificates_id; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row align-items-center">								
                                                
                                                <div class="col-md-12 col-sm-12 col-xs-12">	
                                                    <label>Business Attachment</label>
                                                </div>

                                                <?php $hideClass = (isset($cerificate['certificate_attachment']) && $cerificate['certificate_attachment'] !="")?"hide-attachment":""; ?>
                                                <div class="col-md-12 col-sm-12 col-xs-12 attachment-file <?php echo $hideClass; ?>">
                                                    <div class="form-group">
                                                        <input type="file" name="business_certificates_file[]" class="form-control form-control-user">												
                                                    </div>
                                                </div>

                                                <?php if(isset($cerificate['certificate_attachment']) && $cerificate['certificate_attachment'] !="") { ?>									
                                                    <div class="col-md-10 col-sm-9 col-xs-8">
                                                        <div class="form-group">												
                                                            File : <a href="<?php echo base_url().$cerificate['certificate_attachment'] ?>" target="_blank"><?php echo base_url().$cerificate['certificate_attachment'] ?></a>												
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-3 col-xs-4 text-right">
                                                        <div class="form-group">
                                                            <span class="action-btn btn btn-sm btn-secondary btn-circle edit-attachment"><i class="fas fa-pencil-alt"></i></span>
                                                        </div>
                                                    </div>

                                                <?php } ?>
                                                                                
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-2 text-center">
                                            <div class="action-btns">
                                                <span class="action-btn add-certificate btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                                <span class="action-btn remove-certificate btn btn-danger btn-circle" data-certificateid="<?php echo $cerificate['id']; ?>"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="card owner light-gray-card">

                            <div class="card-title-wrapper">
                                <h2>Other Business Certificates</h2>
                                <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                            </div>

                            <div class="card-inside">
                            
                                <div class="row align-items-center">              
                                    <div class="col-md-10 col-sm-10 col-10">

                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Business Certificate</label>
                                                    <select name="business_certificates[]" class="form-control form-control-user business_certificates custom-select">
                                                        <option value="">Select Business Certificate</option>
                                                        <option value="Women Owned">Women Owned</option>
                                                        <option value="Veteran Owned">Veteran Owned</option>                                                            
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Certificates ID</label>
                                                    <input type="text" name="business_certificates_id[]" class="form-control form-control-user" placeholder="Certificate ID" value="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Attachment</label>
                                                    <input type="file" name="business_certificates_file[]" class="form-control form-control-user">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-2 col-sm-2 col-2 text-center">
                                        <div class="action-btns">
                                            <span class="action-btn add-certificate btn btn-success btn-circle"><i class="fas fa-plus-circle"></i></span>
                                            <span class="action-btn remove-certificate btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <?php
                    }
                    ?>
                    <input type="hidden" id="remove_business_certificates" name="remove_business_certificates[]">
                </div>

                <hr class="sidebar-divider">

                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $business['id']?>">
                    <input type="hidden" name="action" value="edit_business">
                    <input type="hidden" id="is_saving" name="is_saving" value="">
                    <input type="hidden" id="is_saving_business" name="is_saving_business" value="front">
                    <input type="submit" class="btn btn-primary btn-gold" value="Save">
                </div>
            
            </form>
        <?php 
        } else {
            ?>
            <div class="heading verification-page">
                <p>Continue Searching For Black Businesses</p>
                <p><a href="<?php echo base_url();?>" class="btn btn-primary">Home</a></p>
            </div>
            <?php
        }
        ?>
    </div>    
    
<?php 
require_once('footer.php');