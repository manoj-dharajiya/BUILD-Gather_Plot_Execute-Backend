<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->

<?php 
global $user;
$intials1 = explode(' ',$user['name']);
$intials = substr($intials1[0],0,1);
$intials .= substr($intials1[1],0,1);
?>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">      
      <div class="mr-2 d-none d-lg-inline">
        <span class="d-block text-gray-600 medium"><?php echo $user['name']; ?></span>
        <span class="d-block text-gray-600 small"><?php echo $user['user_type']; ?></span>
      </div>
      <span class="btn btn-secondary btn-circle rounded-circle">
        <i class="fas fa-user"></i>        
      </span>      
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">      
      <!-- <div class="dropdown-divider"></div> -->
      <a class="dropdown-item" href="<?php echo base_url()?>logout" >
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>
<!-- End of Topbar -->