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
        
        if(isset($businessWarning) && $businessWarning != "") { 
            $type = ($businessWarning['type'] == 'error')?"danger":$businessWarning['type'];
            ?>
            <div class="alert warning-wrapper alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <p><?php echo $businessWarning['message']; ?></p>
                <?php if(isset($businessWarning['warnings'])){?>
                    <ul>
                        <?php foreach($businessWarning['warnings'] as $bus) {?>
                            <li><?php echo $bus['business_name']?> - <a href="#" data-id="<?php echo $bus['id']; ?>" data-title="<?php echo $bus['business_name']; ?>" data-link="<?php echo base_url()."edit-my-business/".md5($bus['id']); ?>" class="verify-business-btn">Verify Now</a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        <?php                    
        }
        ?>

        <div class="heading">
            <h1>Black Businesses in Montgomery County, MD</h1>
        </div>

        <?php

        if(isset($_REQUEST['action']) && ($_REQUEST['action'] == 'add_favorite' || $_REQUEST['action'] == 'remove_favorite')) {
            $searchActive = "";
            $favotireActive = "show active";
            $myBusinessActive = "";
        } else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'search') {
            $searchActive = "show active";
            $favotireActive = "";
            $myBusinessActive = "";
        } else if(!isset($_REQUEST['action']) && $myBusiness && $myFavoriteBusiness ) {
            $searchActive = "";
            $favotireActive = "";
            $myBusinessActive = "show active";
        } else if(!isset($_REQUEST['action']) && !$myBusiness && $myFavoriteBusiness ) {
            $searchActive = "";
            $favotireActive = "show active";
            $myBusinessActive = "";
        } else if(!isset($_REQUEST['action']) && $myBusiness && !$myFavoriteBusiness ) {
            $searchActive = "";
            $favotireActive = "";
            $myBusinessActive = "show active";
        } else {
            $searchActive = "show active";
            $favotireActive = "";
            $myBusinessActive = "";
        }

        if($myBusiness || $myFavoriteBusiness) { ?>

            <ul class="nav nav-tabs my-business-tabs" role="tablist">            
                
                <li class="nav-item">
                    <a class="nav-link <?php echo $searchActive; ?>" href="#search-business" id="search-business-tab" data-toggle="tab" role="tab" aria-controls="search-business" aria-selected="false">Search Businesses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo $favotireActive; ?>" href="#my-favourite" id="my-favourite-tab" data-toggle="tab" role="tab" aria-controls="my-favourite" aria-selected="true">Favorites</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo $myBusinessActive; ?>" href="#my-businesses" id="my-businesses-tab" data-toggle="tab" role="tab" aria-controls="my-businesses" aria-selected="true">My Business</a>
                </li>            

            </ul>

        <?php } ?>

        <div class="tab-content">                        

            <div id="search-business" role="tabpanel" class="tab-pane fade <?php echo $searchActive; ?>">

                <div class="search-form">
                    <div class="container">
                        <form method="post">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">                            
                                    <div class="form-group">                
                                        <select id="primary_category" name="primary_category" class="form-control form-control-user required  custom-select">
                                            <option value="all">All Categories</option>
                                            <?php
                                            if($primary_category) {
                                                for($i=0;$i<count($primary_category);$i++) {
                                                ?>      
                                                    <option <?php if(isset($_REQUEST['primary_category']) && $_REQUEST['primary_category'] == $primary_category[$i]['id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $primary_category[$i]['id']?>"><?php echo $primary_category[$i]['name']?></option>
                                                <?php }
                                            }?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group form-input-wrapper">
                                        <input id="search" name="search" type="text" class="form-control form-control-user" placeholder="What are you looking for..." value="<?php echo $searchTerm; ?>">
                                    
                                        <input type="hidden" name="action" value="search" />

                                        <button type="submit" class="btn">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="search-results">
                    
                    <div class="">
                        <?php if($search) { ?>
                        <table id="search_results" class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <td width="10%">Business Name</td>
                                    <td width="15%">Company Info</td>
                                    <td width="10%">Business Category</td>
                                    <td width="10%">Address</td>
                                    <td width="5%">Contact</td>                            
                                    <td width="10%">&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($search as $item) {
                                        get_row($item,$user);
                                    }
                                ?>
                            </tbody>
                        </table>
                        <?php }

                        if(isset($pagging) && isset($pagging['next']) && $pagging['next'] != 'disable') {
                            ?>
                            <div id="basic_waypoint" class="load-more text-center">
                                <a href="#" data-loading="no" data-url="<?php echo base_url()."load-more-search"; ?>" data-page="<?php echo $pagging['next']; ?>" class="btn btn-primary btn-large">Load More</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>                    
                </div>
            </div>

            <div id="my-favourite" role="tabpanel" class="tab-pane fade <?php echo $favotireActive; ?> ">

                <div class="search-results">                    
                    
                    <table id="my_businesses_results" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <td width="10%">Business Name</td>
                                <td width="15%">Company Info</td>
                                <td width="10%">Business Category</td>
                                <td width="10%">Address</td>
                                <td width="5%">Contact</td>                            
                                <td width="10%">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($myFavoriteBusiness) {
                                    foreach($myFavoriteBusiness as $item) {
                                        get_row($item,$user);
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="6"><p class="text-center no-margin"> No Business Available </p></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                </div>

            </div>

            <div id="my-businesses" role="tabpanel" class="tab-pane fade <?php echo $myBusinessActive; ?> ">

                <div class="search-results">
                        
                    <table id="my_businesses_results" class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <td width="10%">Business Name</td>
                                <td width="15%">Company Info</td>
                                <td width="10%">Business Category</td>
                                <td width="10%">Address</td>
                                <td width="5%">Contact</td>                            
                                <td width="10%">&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                if($myBusiness) {                             
                                    foreach($myBusiness as $item) {
                                        get_row($item,$user);
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="6"><p class="text-center no-margin"> No Business Available </p></td>
                                    </tr>
                                <?php }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>    
    
    <!-- Modal -->
    <div class="modal fade medium" id="details-popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="compnay_logo">
                        <div class="company-img">
                            <div class="company-img-1">
                                <img id="company_logo_img" data-baseurl="<?php echo base_url(); ?>" src="" alt="">
                            </div>
                            <div class="company-title">
                                <span id="company_name" class="company_name"></span>
                            </div>
                        </div>
                        <div class="claim-company-btn">
                            <a href="#" id="claim_business_request" data-businessid="" class="btn btn-primary btn-small" data-target="#claim_business_request">Claim Business</a>
                        </div>
                    </div>
                    <table class="table table-bordered dataTable">
                        <tr id="products-services">
                            <th>Company Info</th>
                            <td>
                                <div class="products-services"></div>
                            </td>
                        </tr>
                        <tr>
                            <th with="23%">Email</th>                            
                            <td width="77%"><span class="email"></span></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><span class="phone"></span></td>
                        </tr>                        
                        <tr>
                            <th>Owners</th>
                            <td>
                                <div class="owners">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Primary Poc Name</th>
                            <td>
                                <span class="primary_poc_name"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Primary Poc Email</th>
                            <td>
                                <span class="primary_poc_email"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Primary Poc Phone</th>
                            <td>
                                <span class="primary_poc_phone"></span>
                            </td>
                        </tr>
                        <tr id="show_address">
                            <th>Address</th>
                            <td>
                                <i class="fas fa-map-marker-alt"></i> <span class="address address-area"></span>
                            </td>
                        </tr>
                        <tr id="show_website">
                            <th>Website</th>
                            <td>
                                <i class="fas fa-globe"></i> <span class="website"></span>
                            </td>
                        </tr>
                        <tr id="primary-category">
                            <th>Business Category</th>
                            <td>
                                <i class="fas fa-bookmark"></i> <span class="primary_category"></span>
                            </td>
                        </tr>                        
                        <tr id="social-medias">
                            <th>Social Accounts</th>
                            <td>
                                <div class="social-medias"></div>
                            </td>
                        </tr>
                        
                        
                    </table>
                </div>                
            </div>
        </div>
    </div>

    <div class="modal fade small" id="phone-popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Contact <span>[business name]</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center"> <i class="fas fa-mobile-alt"></i> <span class="phone-text"></span> </h3>
                </div>                
            </div>
        </div>
    </div>    

    <?php if(!$user) { ?>

    <div class="modal fade small" id="signup-popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Signup</h4>
                    <?php 
                    if(isset($errorMeesage)) { 
                        $type = ($errorMeesage['type'] == 'error')?"danger":$errorMeesage['type'];
                        ?>
                        <div class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?php echo $errorMeesage['message']; ?>
                        </div>
                    <?php                    
                    }
                    ?>

                    <form method="post" class="user" id="signup-form">
                        <div class="form-group">
                            <input id="name" name="name" type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input id="email" name="email" type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input id="password" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input id="cpassword" name="cpassword" type="password" class="form-control form-control-user" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="action" value="signup_form">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Signup
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="#" class="small" data-toggle="modal" data-target="#login-popup" data-dismiss="modal">Login</a> | 
                        <a href="#" class="small" data-toggle="modal" data-target="#forgotpassword-popup" data-dismiss="modal">Forgot Password?</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade small" id="login-popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Login</h4>

                    <?php 
                    if(isset($errorMeesage)) { 
                        $type = ($errorMeesage['type'] == 'error')?"danger":$errorMeesage['type'];
                        ?>
                        <div class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?php echo $errorMeesage['message']; ?>
                        </div>
                    <?php                    
                    }
                    ?>

                    <form method="post" class="user" id="signup-form">
                        <div class="form-group">
                            <input id="email" name="email" type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </div>
                        <div class="form-group">
                            <input id="password" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                        </div>
                        <input type="hidden" name="action" value="login_form">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                    <a href="#" class="small" data-toggle="modal" data-target="#signup-popup" data-dismiss="modal">Sign Up</a> |
                    <a href="#" class="small" data-toggle="modal" data-target="#forgotpassword-popup" data-dismiss="modal">Forgot Password?</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade small" id="forgotpassword-popup" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Forgot Password</h4>

                    <?php 
                    if(isset($errorMeesage)) { 
                        $type = ($errorMeesage['type'] == 'error')?"danger":$errorMeesage['type'];
                        ?>
                        <div class="alert alert-<?php echo $type;?> alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?php echo $errorMeesage['message']; ?>
                        </div>
                    <?php                    
                    }
                    ?>

                    <form method="post" class="user" id="login-form">
                        <div class="form-group">
                            <input id="email" name="email" type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </div>
                        <input type="hidden" name="action" value="forgot_request">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Submit
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="#" class="small" data-toggle="modal" data-target="#signup-popup" data-dismiss="modal">Signup</a> |
                        <a href="#" class="small" data-toggle="modal" data-target="#login-popup" data-dismiss="modal">Login</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php } ?> 

    <?php
    function get_row($item,$user=[]) {
        $address = "";
        if(isset($item['business_address']['is_address_hidden']) && $item['business_address']['is_address_hidden'] != 'yes') {
            $address = $item['business_address']['address']."</br>";
        }
        $address .= "<span class='address-area'>".strtolower($item['business_address']['city'])."</span>, ";
        $address .= "<span class='address-area'>".strtolower($item['business_address']['state'])."</span> - ";
        $address .= $item['business_address']['zipcode'];
        $blog_logo = $item['business_logo'];
        ?>
        <tr>
            <td>
                <div class="show-details" data-id="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#details-popup">
                    <?php
                    if($blog_logo) {
                    ?>
                        <a href="javascript:void(0)" class="underlined">
                            <img src="<?php echo base_url().'/'.$blog_logo; ?>"  alt=""/>
                        </a> <br/>
                    <?php } ?>
                    <a href="javascript:void(0)" class="underlined">
                        <?php echo $item['business_name']; 
                        ?>
                    </a>
                
                </div>
            </td>
            <td><?php echo substr($item['business_desc'],0,100);?>...</td>
            <td><?php echo $item['primary_category']; ?></td>
            <td class="address-area"><i class="fas fa-map-marker-alt"></i> <?php echo $address; ?></td>
            <td class="text-center">
                <div class="social-icons-list">
                    <?php if(isset($item['business_phone']) && $item['business_phone'] != ""){ ?>
                        <a href="#" class="desktop-phone-number show-phone" data-bustitle="<?php echo $item['business_name']; ?>" data-phone="<?php echo $item['business_phone']; ?>"><i class="fas fa-mobile-alt"></i></a>
                        <a href="tel:<?php echo $item['business_phone']; ?>" class="mobile-phone-number"><i class="fas fa-mobile-alt"></i></a>
                    <?php 
                    }

                    if(isset($item['business_address']['website']) && $item['business_address']['website'] != ""){
                        $website = (!strpos($item['business_address']['website'],'http'))?"http://".$item['business_address']['website']:$item['business_address']['website'];
                        $item['business_address']['website'] = $website;
                        ?>                                            
                        <a href="<?php echo $website; ?>" target="_blank"><i class="fas fa-globe"></i></a>
                    <?php }
                    
                    if(isset($item['business_fields']['social_media'])){
                        for($i=0;$i<count($item['business_fields']['social_media']);$i++){

                            $link = $item['business_fields']['social_media'][$i]['social_link'];
                            $link = (!strpos($link,'http'))?"http://".$link:$link;
                            $item['business_fields']['social_media'][$i]['social_link'] = $link;

                            switch ($item['business_fields']['social_media'][$i]['social_media']) {
                                case "facebook":
                                    $fontIcon = "fa-facebook-square";
                                    break;
                                case "instagram":
                                    $fontIcon = "fa-instagram";
                                    break;
                                case "twitter":
                                    $fontIcon = "fa-twitter";
                                    break;
                                case "linkedin":
                                    $fontIcon = "fa-linkedin";
                                    break;
                                case "youtube":
                                    $fontIcon = "fa-youtube";
                                    break;
                                default:
                                    $fontIcon = "";
                                    break;
                            }
                            ?>
                            <a href="<?php echo $link; ?>" target="_blank"><i class="fab <?php echo $fontIcon; ?>"></i></a>
                            <?php 
                        }
                    }
                    ?>
                </div>
            </td>
            <td class="text-center">
                <?php if(!$user) { ?>
                    <a href="<?php echo base_url()?>login" class="btn btn-primary btn-circle toggle-favorite mt-2" title="Add To Favorites">
                        <i class="far fa-heart"></i>
                    </a>
                <?php } else {                                                    
                    $heartIcon = (isset($item['is_favorite']) && $item['is_favorite'] == 'Yes')?'fas fa-heart':'far fa-heart';
                    $addToText = (isset($item['is_favorite']) && $item['is_favorite'] == 'Yes')?'Remove from Favorites':'Add To Favorites';
                    $favoriteAction = (isset($item['is_favorite']) && $item['is_favorite'] == 'Yes')?'remove_favorite':'add_favorite';
                    ?>
                        <a href="<?php echo base_url()?>?action=<?php echo $favoriteAction; ?>&business_id=<?php echo md5($item['id']); ?>" class="btn btn-primary btn-circle toggle-favorite mt-2" title="<?php echo $addToText; ?>">
                            <i class="<?php echo $heartIcon; ?>"></i>
                        </a>
                    <?php
                } ?>
                <a href="#" class="btn btn-primary btn-circle show-details  mt-2" data-id="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#details-popup" title="Show More"><i class="fas fa-eye"></i></a>
                <script>business[<?php echo $item['id']; ?>] = <?php echo json_encode($item); ?> </script>
                
                <?php if($user && $user[0]['id'] == $item['user_id']) { ?>
                    <a href="<?php echo base_url()?>edit-my-business/<?php echo md5($item['id']);?>" class="btn btn-primary btn-circle edit-btn mt-2" title="Update Business"><i class="fas fa-pencil-alt"></i></a>
                <?php } ?>

                <?php if($user && $user[0]['id'] == $item['user_id'] && isset($item['is_verfication_certificate_added']) && $item['is_verfication_certificate_added'] == 'No' ) { ?>
                    <a href="#" data-id="<?php echo $item['id']; ?>" data-title="<?php echo $item['business_name']; ?>" data-link="<?php echo base_url()?>edit-my-business/<?php echo md5($item['id']);?>" class="btn btn-primary  btn-circle verify-business-btn mt-2" title="Verify Now"><i class="fas fa-file-invoice"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php
    }

require_once('footer.php');   