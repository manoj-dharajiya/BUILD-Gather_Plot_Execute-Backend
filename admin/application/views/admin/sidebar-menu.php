<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>admin/">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div> -->
    <div class="sidebar-brand-text mx-3">
        <img src="<?php echo base_url()?>assets/images/logo.png" alt="">
    </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url()?>admin/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Requests
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>focus-group-list">
            <i class="fas fa-fw fa-business-time"></i>
            <span>Participate In Focus Groups</span>
        </a>        
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>become-partner-list">
            <i class="fas fa-fw fa-business-time"></i>
            <span>Become A Partner</span>
        </a>        
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>want-in-list">
            <i class="fas fa-fw fa-business-time"></i>
            <span>I WANT IN</span>
        </a>        
    </li>

    

    <!-- Heading -->
    <div class="sidebar-heading">
        Users
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>admin/users">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>        
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>admin/notifications">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Notification</span>
        </a>        
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url()?>admin/settings">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Settings</span>
        </a>        
    </li>    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
    <!-- End of Sidebar -->