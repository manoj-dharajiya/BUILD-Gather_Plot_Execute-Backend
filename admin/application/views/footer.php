    
        </div>
        <!-- !Page-Wrapper -->        

        <div class="copyright">
            <p>All Rights Reserved 2021. Powered by <a href="https://www.theblackbusinesscouncil.org/" target="_blank">Black Business Council</a></p>
        </div>        
        
        <!-- Modal -->
        <div class="modal fade" id="request-business"  tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add My Business </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-bussiness" action="<?php echo base_url();?>business/add-new" method="post" enctype="multipart/form-data">

                            <div class="intro-text">
                                <p>To be considered for the Black Business Database, your business must be at least 51% Black-Owned and located in Montgomery County, MD.</p>
                            </div>

                            <div id="step-1" class="form-steps active">
                            
                                <div class="owner card">

                                    <div class="card-title-wrapper">
                                        <h2>Business Details</h2>
                                        <!-- <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3> -->
                                    </div>
                                    
                                    <div class="card-inside">
                                        
                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Legal Business Name <span class="required-field">*</span></label>
                                                    <input id="business_name" name="name" type="text" class="form-control form-control-user required" placeholder="Legal Business Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Doing Business As (DBA)</label>
                                                    <input id="business_dba" name="dba" type="text" class="form-control form-control-user required" placeholder="DBA">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <label>Business Category <span class="required-field">*</span></label>
                                                <div class="form-group">                
                                                    <select id="primary_category" name="primary_category" class="form-control form-control-user required  custom-select">
                                                        <option value="">Business Category</option>
                                                        <?php
                                                        if($all_category) {
                                                        for($i=0;$i<count($all_category);$i++) {
                                                        ?>      
                                                            <option value="<?php echo $all_category[$i]['id']?>"><?php echo $all_category[$i]['name']?></option>
                                                        <?php }
                                                        }?>
                                                        
                                                    </select>
                                                </div>
                                            </div>   

                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Website </label>
                                                    <input id="website" name="website" type="text" class="form-control form-control-user" placeholder="Website">
                                                </div>
                                            </div>                             

                                        </div>

                                        <div class="row align-items-center">
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Address <span class="required-field">*</span></label>
                                                    <input id="address" name="address" type="text" class="form-control form-control-user required" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>City <span class="required-field">*</span></label>
                                                    <input id="city" name="city" type="text" class="form-control form-control-user required" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>State <span class="required-field">*</span></label>
                                                    <select name="state" class="form-control required form-control-user custom-select">
                                                        <option value="">Select State</option>
                                                        <?php foreach($states as $state){ ?>
                                                        <option <?php if($state == "Maryland"){ echo 'selected="selected"';}?> value="<?php echo $state; ?>"><?php echo $state; ?></option>                    
                                                        <?php } ?>
                                                    </select>
                                                    <!-- <input id="state" name="state" type="text" class="form-control form-control-user required" placeholder="State"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Zip Code <span class="required-field">*</span></label>
                                                    <input id="zipcode" name="zipcode" type="text" class="form-control form-control-user required" placeholder="Zip Code">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label><input type="checkbox" name="is_address_hidden" value="yes" checked> Hide my street address.</label>
                                                </div>
                                            </div>

                                        </div>                                

                                        <div class="row align-items-center">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Business Phone <span class="required-field">*</span></label>
                                                    <input id="phone" name="phone" type="text" class="form-control form-control-user phone-number-change required" placeholder="(XXX) XXX-XXXX">
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Business Email <span class="required-field">*</span></label>
                                                    <input id="email" name="email" type="email" class="form-control form-control-user required" placeholder="Email Address">
                                                    <span class="errMsg"></span>
                                                </div>   
                                            </div>
                                        </div>                            
                                        
                                        <div class="form-group">
                                            <label>Company Info <span class="required-field">*</span></label>
                                            <textarea name="business_desc" class="form-control form-control-user admin-notes"></textarea>                                      
                                        </div>

                                        <div class="form-group">
                                            <label>Business Logo</label>
                                            <div class="row align-items-center">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="file" id="upload_image" name="business_logo" class="form-control form-control-user">
                                                    <input type="hidden" id="business_logo" name="business_logo_2" value="">
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <img id="preview-image" src="" alt="" />
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="owners-details">

                                    <div id="owners-details-wrapper">
                                        <div class="owner card light-gray-card">

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

                                    </div>
                                    
                                </div>
                                
                                <div class="card owner">

                                    <div class="card-title-wrapper extra-space">
                                        <h2>Primary POC</h2>
                                        <h3>You can use the "Set as POC" button above to pre-fill this area or you can simply add a new contact.</h3>
                                    </div>

                                    <div class="card-inside">

                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>First Name <span class="required-field">*</span></label>
                                                    <input id="primary_poc_first_name" name="primary_poc_first_name" type="text" class="form-control form-control-user required" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Last Name <span class="required-field">*</span></label>
                                                    <input id="primary_poc_last_name" name="primary_poc_last_name" type="text" class="form-control form-control-user required" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Email <span class="required-field">*</span></label>
                                                    <input id="primary_poc_email" name="primary_poc_email" type="email" class="form-control form-control-user required" placeholder="Email">
                                                    <span class="errMsg"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Phone <span class="required-field">*</span></label>
                                                    <input id="primary_poc_phone" name="primary_poc_phone" type="text" class="form-control phone-number-change form-control-user required" placeholder="(XXX) XXX-XXXX">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                                            
                                <div id="social-wrapper">
                                    <div class="card owner light-gray-card">

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
                                                                    <option value="youtube">YouTube</option>
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
                                </div>
                                
                                <div id="business-certificate-wrapper">
                                    <div class="card owner">

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
                                                                <label>Business Certificates ID</label>
                                                                <input type="text" name="business_certificates_id[]" class="form-control form-control-user" placeholder="Business Certificates ID" value="">
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
                                </div>  

                                <hr class="sidebar-divider">

                                <button id="next-step" class="btn save-btn btn-primary">Next</button>
                                <input type="button" class="btn btn-primary close-modal" value="Cancel">

                            </div>

                            <div id="step-2" class="form-steps">
                                <div id="business-certificate-wrapper-1">
                                    <div class="card owner light-gray-card">

                                        <div class="card-title-wrapper">
                                            <div class="d-flex justify-content-between align-item-center">
                                                <h2>Black-Owned Verification Method</h2>                                        
                                                <div class="form-group no-margin">
                                                    <!-- <label>
                                                        <input id="verify_business_later" type="checkbox" name="verify_business_later" value="yes">
                                                        Verify Business Later
                                                    </label> -->
                                                </div>
                                            </div>                                        
                                        </div>

                                        <div id="business_verification_wrapper">
                                            <div class="card-inside">
                                            
                                                <div class="row align-items-center">              
                                                    <div class="col-md-12 col-sm-12 col-12">

                                                        <div class="row align-items-center">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Choose a way to verify below. <span class="required-field">*</span></label>
                                                                    <select id="business_certificates" name="black_owned_certificates" class="form-control form-control-user required business_certificates custom-select">
                                                                        <option value="">Select Verification Type</option>
                                                                        <option value="MD MBE">MD MBE</option>
                                                                        <option value="Other MBE">Other MBE</option>
                                                                        <option value="Affidavit">Affidavit</option>
                                                                        <option value="Third Party Certification">Third Party Certification</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">                                                        
                                                                <div class="affidavit_example_file text-right">
                                                                    <a href="<?php echo base_url().$settings[0]['option_value'];?>" target="_blank">Download Affidavit Template</a>
                                                                </div>
                                                                <div id="business_certificates_id" class="business_certificates_id">
                                                                    <div class="form-group">
                                                                        <label>Certificate ID <span class="abriviations_text">(include state abbreviation)</span> <span class="required-field">*</span></label>
                                                                        <input type="text" name="black_owned_certificates_id" class="form-control form-control-user required" placeholder="Certificate ID" value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row align-items-center">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div id="business_certificates_attachment" class="">
                                                                    <div class="form-group">
                                                                        <label>Attachment <span class="required-field">*</span></label>
                                                                        <input type="file" name="black_owned_certificates_file" class="form-control form-control-user required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>                                        
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="sidebar-divider">

                                <div class="form-group">                                
                                    <input type="hidden" name="action" value="front_save_business">
                                    <input type="hidden" id="is_saving" name="is_saving" value="">
                                    <input type="hidden" id="verify_business_later" name="verify_business_later" value="">
                                    
                                    <button id="previous-step" type="button" class="btn save-btn btn-primary">Back</button>                                    
                                    <input id="verify-later" type="button" class="btn save-btn btn-primary" value="Verify Later">
                                    <input id="submit-btn" type="button" class="btn save-btn btn-primary" value="Submit">
                                    <!-- <input type="button" class="btn btn-primary close-modal" value="Cancel"> -->
                                </div>
                                                            
                            </div>

                            <!-- <label>Black Ownership Status / Proof <span class="required-field">*</span></label>
                            <div class="form-group">                                
                                <input type="file" id="black_ownership_status" name="black_ownership_status" class="form-control form-control-user required">                                
                            </div> -->

                            

                        </form>
                    </div>                    
                </div>
            </div>
        </div>

        <!-- Claim Business Modal  -->
        <div class="modal medium fade" id="claim_business_request_modal"  tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Claim Business - <span class="company_name"> </span> </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="claim-business-request" action="<?php echo base_url();?>business/add-claim-business-request" method="post" enctype="multipart/form-data" data-pageurl="<?php echo base_url();?>">

                            <div class="intro-text">
                                <p>To be considered for the Black Business Database, your business must be at least 51% Black-Owned and located in Montgomery County, MD.</p>
                            </div>                           
                            
                            <div id="business-certificate-wrapper-1">
                                <div class="card owner">
                                    <!-- <div class="card-title-wrapper">
                                        <h2>Social Media</h2>
                                    </div> -->
                                    <div class="card-inside">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Name <span class="required-field">*</span></label>
                                                    <input id="request_first_name" name="request_first_name" type="text" class="form-control form-control-user required" placeholder="Name">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Last Name <span class="required-field">*</span></label>
                                                    <input id="request_last_name" name="request_last_name" type="text" class="form-control form-control-user required" placeholder="Last Name">
                                                </div>
                                            </div> -->
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Phone <span class="required-field">*</span></label>
                                                    <input id="request_phone" name="request_phone" type="text" class="form-control phone-number-change form-control-user required" placeholder="(XXX) XXX-XXXX">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Email <span class="required-field">*</span></label>
                                                    <input id="request_email" name="request_email" type="email" class="form-control form-control-user required" placeholder="Email">
                                                    <span class="errMsg"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Confirm Email <span class="required-field">*</span></label>
                                                    <input id="confirm_request_email" name="confirm_request_email" type="email" class="form-control form-control-user required" placeholder="Confirm Email">
                                                    <span class="errMsg"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>URL </label>
                                                    <input id="request_url" name="request_url" type="text" class="form-control form-control-user" placeholder="URL">
                                                    <span class="errMsg"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Notes </label>
                                                    <textarea id="request_note" name="request_note" class="form-control form-control-user" placeholder="Notes"></textarea>
                                                    <!-- <input id="request_phone" name="request_phone" type="text" class="form-control phone-number-change form-control-user required" placeholder="(XXX) XXX-XXXX"> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card owner light-gray-card">

                                    <div class="card-title-wrapper">
                                        <h2>Black-Owned Verification Method</h2>                                        
                                    </div>

                                    <div class="card-inside">
                                    
                                        <div class="row align-items-center">              
                                            <div class="col-md-12 col-sm-12 col-12">

                                                <div class="row align-items-center">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Choose a way to verify below. <span class="required-field">*</span></label>
                                                            <select id="business_certificates" name="black_owned_certificates" class="form-control form-control-user required business_certificates custom-select">
                                                                <option value="">Select Verification Type</option>
                                                                <option value="MD MBE">MD MBE</option>
                                                                <option value="Other MBE">Other MBE</option>                                                                
                                                                <option value="Affidavit">Affidavit</option>
                                                                <option value="Third Party Certification">Third Party Certification</option>                                                            
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="affidavit_example_file text-right">
                                                            <a href="<?php echo base_url().$settings[0]['option_value'];?>" target="_blank">Download Affidavit Template</a>
                                                        </div>
                                                        <div id="business_certificates_id" class="business_certificates_id">
                                                            <div class="form-group">
                                                                <label>Certificate ID <span class="abriviations_text">(include state abbreviation)</span> <span class="required-field">*</span></label>
                                                                <input type="text" name="black_owned_certificates_id" class="form-control form-control-user required" placeholder="Certificate ID" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div id="business_certificates_attachment" class="">
                                                            <div class="form-group">
                                                                <label>Attachment <span class="required-field">*</span></label>
                                                                <input type="file" name="black_owned_certificates_file" class="form-control form-control-user required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>                                        
                                        </div>
                                        
                                    </div>

                                </div>
                            </div> 

                            <!-- <label>Black Ownership Status / Proof <span class="required-field">*</span></label>
                            <div class="form-group">                                
                                <input type="file" id="black_ownership_status" name="black_ownership_status" class="form-control form-control-user required">                                
                            </div> -->

                            <hr class="sidebar-divider">                            

                            <div class="form-group no-margin">
                                <input type="hidden" name="action" value="claim_business_request">
                                <input type="hidden" id="claim_business_id" name="business_id" value="">                                
                                <input type="hidden" id="claim_business_save_btn"  value="">
                                <input type="submit" class="btn save-btn btn-primary" value="Save">
                                <input type="button" class="btn btn-primary close-modal" data-dismiss="modal" value="Cancel">
                            </div>

                        </form>
                    </div>                    
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal medium fade" id="crop-img-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop Image <span class="">To zoom in and out of your image, use the scroll up and down feature on your mouse/keypad.</span></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">                            
                        <div class="img-container">
                            <img id="image" src="" alt="" />
                        </div>
                        <!-- <div id="logo_img_wrapper" style="width:100%; margin:30px auto 0;"></div> -->
                    </div>
                    <div class="modal-footer" style="justify-content: left;">                            
                        <button id="crop_image" type="button" class="btn btn-primary">Crop Image</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Modal -->
        <div class="modal medium fade" id="business_certificate_verification_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="business_certificate_verification" method="post" enctype="multipart/form-data">
                        <div class="modal-body">                            
                            <div id="business-certificate-wrapper-2">
                                <div class="card owner light-gray-card">

                                    <div class="card-title-wrapper">
                                        <div class="d-flex justify-content-between align-item-center">
                                            <h2>Black-Owned Verification Method</h2>                                        
                                            <div class="form-group no-margin">
                                                <a class="business_edit_link" href="#">Show More Fields</a>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div id="business_verification_wrapper">
                                        <div class="card-inside">
                                        
                                            <div class="row align-items-center">              
                                                <div class="col-md-12 col-sm-12 col-12">

                                                    <div class="row align-items-center">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Choose a way to verify below. <span class="required-field">*</span></label>
                                                                <select id="business_certificates" name="black_owned_certificates" class="form-control form-control-user required business_certificates custom-select">
                                                                    <option value="">Select Verification Type</option>
                                                                    <option value="MD MBE">MD MBE</option>
                                                                    <option value="Other MBE">Other MBE</option>
                                                                    <option value="Affidavit">Affidavit</option>
                                                                    <option value="Third Party Certification">Third Party Certification</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">                                                        
                                                            <div class="affidavit_example_file text-right">
                                                                <a href="<?php echo base_url().$settings[0]['option_value'];?>" target="_blank">Download Affidavit Template</a>
                                                            </div>
                                                            <div id="business_certificates_id" class="business_certificates_id">
                                                                <div class="form-group">
                                                                    <label>Certificate ID <span class="abriviations_text">(include state abbreviation)</span> <span class="required-field">*</span></label>
                                                                    <input type="text" name="black_owned_certificates_id" class="form-control form-control-user required" placeholder="Certificate ID" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div id="business_certificates_attachment" class="">
                                                                <div class="form-group">
                                                                    <label>Attachment <span class="required-field">*</span></label>
                                                                    <input type="file" name="black_owned_certificates_file" class="form-control form-control-user required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>                                        
                                            </div>
                                            
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="justify-content: left;"> 
                            <input type="hidden" class="business_id" name="business_id" value="">
                            <input type="hidden" name="action" value="add_business_verification_certificates">
                            <button id="verify_btn" type="submit" class="btn btn-primary">Verify Now</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        


        <!-- Bootstrap core JavaScript-->
        <script src="<?php echo base_url();?>theme_assets/vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/lib/cropper/cropper.js"></script>        
        <script src="<?php echo base_url();?>assets/lib/html5lightbox/html5lightbox.js"></script>
        <script src="<?php echo base_url();?>assets/lib/waypoint/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url();?>theme_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?php echo base_url();?>theme_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?php echo base_url();?>theme_assets/js/sb-admin-2.min.js"></script>        

        <script src="<?php echo base_url()?>assets/js/script.js"></script>

        


    </body>
</html>