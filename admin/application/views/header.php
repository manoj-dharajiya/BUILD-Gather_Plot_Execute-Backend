<?php 
// pre($_SERVER);
/* if($_SERVER['REQUEST_SCHEME'] != "https"){
    ?>
    <script>
        window.location.href = "<?php echo base_url()?>";
    </script>
    <?php
} */
?>
<!doctype html>
<html lang="en">
    <head>
        <title><?php echo $pageTitle; ?></title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="<?php echo base_url();?>assets/lib/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap CSS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet"> 

        <link href="<?php echo base_url();?>theme_assets/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="<?php echo base_url();?>assets/lib/cropper/cropper.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/responsive.css">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-187905527"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-187905527');
        </script>

    </head>
    <body>

    <div class="loader"></div>

    <!-- !Page-Wrapper -->
    <div class="page-wrapper">

        <div class="site-header">
            <div class="container">
                <div class="site-wrapper">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo $site_logo;?>" alt="">
                        </a>
                    </div>
                    <div class="navigation">
                        
                        <!-- <span>Have a Black-Owned business?</span> -->
                        <ul>
                            <?php if(!$user) {?>                                
                                <li><a href="#" data-toggle="modal" data-target="#signup-popup">Signup</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#login-popup">Login</a></li>
                            <?php }?>
                            <li><a href="#" data-toggle="modal" data-target="#request-business" class="as-btn add-my-business">Add My Business</a></li>
                            <?php if($user) {?>
                                <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                            <?php }?>
                        </ul>
                        <div class="question">Questions? <a href="mailto:info@theblackbusinesscouncil.org">info@theblackbusinesscouncil.org</a></div>
                    </div>
                </div>
            </div>
        </div>