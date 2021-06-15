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
                <h1 class="h3 mb-4 text-gray-800">Business Categories</h1>
                <a class="add-new" href="#" data-toggle="modal" data-target="#add-category"><i class="fas fa-plus"></i> Add New</a>
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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Category Name</th>
                                <th width="150">Parent</th>
                                <th width="150">Status</th>
                                <th width="150" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            <?php    
                            if($business_categories) {                 
                                for($i=0;$i<count($business_categories);$i++) {
                                    
                                    $time = date('m-d-Y g:i a',$business_categories[$i]['add_time']);
                                    $parent_name = (isset($business_categories[$i]['parent_name']))?$business_categories[$i]['parent_name']:"-";
                                    
                                ?>
                                    <tr>
                                        <td><?php echo $start + $i;?></td>                            
                                        <td><?php echo $business_categories[$i]['name']; ?></td>                            
                                        <td><?php echo $parent_name; ?></td>
                                        <td><?php echo $business_categories[$i]['status']; ?></td>
                                        <td class="text-center">
                                            <a href="#" class="edit-category" data-parent="<?php echo $business_categories[$i]['parent']; ?>" data-name="<?php echo $business_categories[$i]['name']; ?>" data-id="<?php echo $business_categories[$i]['id']; ?>" data-status="<?php echo $business_categories[$i]['status']; ?>">
                                                <span class="action-btn btn btn-secondary btn-circle"><i class="fas fa-pencil-alt"></i></span>
                                            </a>
                                            <a href="<?php echo $baseUrl;?>?action=removeCategory&id=<?php echo $business_categories[$i]['id']; ?>" class="remove-action">
                                                <span class="action-btn btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
                                            </a>
                                        </td>                            
                                    </tr>
                                <?php }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <p>No Category Available</p>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>                        
                    </div>
                    <div class="row">
							<div class="col-sm-12 col-md-5">
								<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing Page <?php echo $pagging['current_page']; ?> of <?php echo $pagging['total_pages']; ?> Pages</div>
							</div>
							<div class="col-sm-12 col-md-7">
								<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
									<ul class="pagination float-right">
										<?php 
											$prvLink = ($pagging['previous'] == "disable")?'#':$pagging['previous'];
											$prvClass = ($pagging['previous'] == "disable")?'disabled':'';
											
											$nextLink = ($pagging['next'] == "disable")?'#':$pagging['next'];
											$nextClass = ($pagging['next'] == "disable")?'disabled':'';
										?>
										<li class="paginate_button page-item previous <?php echo $prvClass; ?>">
											<a href="<?php echo $prvLink; ?>" class="page-link">Previous</a>
										</li>                
										<li class="paginate_button page-item next <?php echo $nextClass; ?>">
											<a href="<?php echo $nextLink; ?>" class="page-link">Next</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        
        
        <!-- Add Category Modal -->
        <div class="modal fade small" id="add-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input id="category_name" name="category_name" type="text" class="form-control form-control-user" placeholder="Primary Category Name">
                            </div>
                            <div class="form-group">
                                <select id="parent_category" name="parent_category" class="form-control form-control-user custom-select">
                                    <option value="">Parent Category</options>
                                    <?php foreach($parent_categories as $category) {?>
                                        <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="add-category">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <!-- <div class="modal-footer text-left">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Edit Category Modal -->
        <div class="modal fade small" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input id="edit_category_name" name="edit_category_name" type="text" class="form-control form-control-user" placeholder="Primary Category Name">
                            </div>
                            <div class="form-group">
                                <select id="edit_parent_category" name="parent_category" class="form-control form-control-user custom-select">
                                    <option value="">Parent Category</options>
                                    <?php foreach($parent_categories as $category) {
                                        ?>
                                        <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                                    <?php 
                                    }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="category_status" name="status">
                                    <label class="custom-control-label" for="category_status"> is Active?</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="category_id" name="category_id" value="edit-category">
                                <input type="hidden" name="action" value="edit-category">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                    <!-- <div class="modal-footer text-left">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div> -->
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
<?php
require_once(__DIR__.'/../footer.php');