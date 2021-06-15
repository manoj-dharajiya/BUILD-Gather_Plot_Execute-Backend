<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $pageTitle; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>theme_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>theme_assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">
    
    <div class="row justify-content-center align-center">

      <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            
            <div class="row">              
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center mb-1 login-logo">
                    <img src="<?php echo base_url().'/assets/images/logo-2.png'?>" alt=""><br/>               
                  </div>

                  <?php 
                  if($message) { 
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
                    <!-- <a class="small" href="<?php echo base_url(); ?>sign-up">Signup</a> | -->
                    <a class="small" href="<?php echo base_url()?>login">Login</a>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>theme_assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>theme_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>theme_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>theme_assets/js/sb-admin-2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/script.js"></script>

</body>

</html>
