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
            <h1 class="h3 mb-4 text-gray-800">Users</h1>
            <a class="add-new" href="#" data-toggle="modal" data-target="#add-user"><i class="fas fa-plus"></i> Add New</a>
        </div>

        <?php 
        if($message) { 
            $type = (isset($message['type']) && $message['type'] != 'error')?$message['type']:"danger";
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
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>                        
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>                        
                        <th>User Type</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>                        
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        for($i=0;$i<count($users);$i++) {
                        ?>
                            <tr>
                                <td><?php echo $start + $i;?></td>                            
                                <td><?php echo $users[$i]['name']; ?></td>
                                <td><?php echo $users[$i]['email']; ?></td>
                                <td><?php echo $users[$i]['user_type']; ?></td>                            
                                <td><?php echo $users[$i]['status']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="edit-user" data-id="<?php echo $users[$i]['id']; ?>" data-name="<?php echo $users[$i]['name']; ?>" data-email="<?php echo $users[$i]['email']; ?>" data-usertype="<?php echo $users[$i]['user_type']; ?>"
                                    data-status="<?php echo $users[$i]['status']; ?>">
                                        <span class="action-btn btn btn-secondary btn-circle"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                    <a href="<?php echo $baseUrl;?>?action=remove-user&id=<?php echo $users[$i]['id']; ?>" class="remove-action">
                                        <span class="action-btn btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                    </a>
                                </td>                            
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade small" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-user-profile" method="post">
                            <div class="form-group">
                                <input id="edit_name" name="edit_name" type="text" class="form-control form-control-user edit_name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input id="edit_email" name="edit_email" type="email" class="form-control form-control-user edit_email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input id="edit_password" name="edit_password" type="password" class="form-control form-control-user" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <select id="edit_user_type" name="user_type" class="form-control form-control-user required custom-select edit_user_type">
                                    <option value="">User Type</option>
                                    <option>Administrator</option>
                                    <option>Subscriber</option>
                                </select>                                
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="edit_user_status" name="status">
                                    <label class="custom-control-label" for="edit_user_status"> is Active?</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="id" value="">
                                <input type="hidden" name="action" value="edit-user">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>

        <!-- Add User Modal -->
        <div class="modal fade small" id="add-user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-user-profile" method="post">
                            <div class="form-group">
                                <input id="name" name="name" type="text" class="form-control form-control-user" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input id="email" name="email" type="email" class="form-control form-control-user" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input id="password" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <select id="user_type" name="user_type" class="form-control form-control-user required custom-select">
                                    <option value="">User Type</option>
                                    <option>Administrator</option>
                                    <option>Subscriber</option>
                                </select>                                
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="user_status" name="status">
                                    <label class="custom-control-label" for="user_status"> is Active?</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="add-user">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
<?php
require_once(__DIR__.'/../footer.php');