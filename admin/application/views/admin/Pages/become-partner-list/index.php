<?php 
require_once(__DIR__.'/../../header.php');
?>    

  <!-- Main Content -->
  <div id="content">

    <?php require_once(__DIR__.'/../../top-bar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid mt-5">
    
      <!-- Page Heading -->
      <div class="heading d-flex align-items-center justify-content-between">
        <h1 class="h3 mb-4 text-gray-800">List</h1>
        <!-- <a class="add-new" href="<?php echo base_url() ?>admin/business/add"><i class="fas fa-plus"></i> Add New</a> -->
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

				<div class="row">
					<div class="col-6">
						<h6 class="m-0 font-weight-bold text-primary">Requests</h6>
					</div>
					<div class="col-6 text-right">
						
						<form method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
							<div class="input-group">								
								<input type="text" name="search" class="form-control bg-light small ml-2" placeholder="Search for..."
								aria-label="Search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<input type="hidden" name="action" value="search">
									<button class="btn btn-primary" type="submit">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>

					</div>
				</div>

			  
            </div>
            <div class="card-body">
              	<div class="table-responsive">
					<div class="dataTables_wrapper dt-bootstrap4">
						<div class="row">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th width="50">#</th>
									<th width="25%">Name</th>																	
									<th>Social Plateform</th>
									<th width="100">Partnership Offering</th>
									<th width="150" class="text-center">Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Social Plateform</th>	
									<th width="100">Partnership Offering</th>				
									<th class="text-center">Action</th>
								</tr>
							</tfoot>
							<tbody>
								<script> var requestList = []; </script>
								<?php 
								
								if(count($lists) > 0) {
									for($i=0;$i<count($lists);$i++) {
										
										$time = date('m-d-Y g:i a',$lists[$i]['add_time']);
									?>
										<tr>
											<td><?php echo $start + $i;?></td>                            
											<td>
												<?php echo $lists[$i]['fname'].' '.$lists[$i]['lname']; ?>
												<?php if($lists[$i]['email']) { ?>
													<br/><i class="far fa-envelope"></i>&nbsp;&nbsp;<?php echo $lists[$i]['email']; ?>
												<?php } ?>
												<?php if($lists[$i]['phone']) { ?>
													<br/><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;<?php echo $lists[$i]['phone']; ?>
												<?php } ?>
											</td>											
											<td>
												<?php echo $lists[$i]['social_plateform']; ?>
												<?php if($lists[$i]['handle_url']) { ?>
													<br/><i class="fas fa-hashtag"></i>&nbsp;&nbsp;<?php echo $lists[$i]['handle_url']; ?>
												<?php } ?>
											</td>
											<td><?php echo $lists[$i]['parnership_offering']; ?></td>											
											<td class="text-center">
												<?php 
												$deleteUrl = "";
												if(strpos($baseUrl,'?search=')) {
													$deleteUrl = $baseUrl.'&action=removePartnerRequest&id='.$lists[$i]['id'];
												} else {
													$deleteUrl = $baseUrl.'?action=removePartnerRequest&id='.$lists[$i]['id'];
												}  
												
												if($lists[$i]['additional_info'] != "") {
												?>										
													<script> requestList[<?php echo $lists[$i]['id']; ?>] = <?php echo json_encode($lists[$i]); ?>;  </script>
													<a href="#" data-id="<?php echo $lists[$i]['id']; ?>" title="Show Comments" class="show-comment-action">
														<span class="action-btn btn btn-info btn-circle"><i class="fas fa-comments"></i></span>
													</a>
												<?php }?>
												<a href="<?php echo $deleteUrl;?>" class="remove-action">
													<span class="action-btn btn btn-danger btn-circle"><i class="fas fa-trash"></i></span>
												</a>
											</td>                            
										</tr>
									<?php }
								} else {
									?>
									<tr>
										<td colspan="5"><p class="text-center">No Request Available.</p></td>
									</tr>
									<?php
								} ?>
							</tbody>
							</table>
						</div>
						<?php // pr($pagging); ?>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing Page <?php echo $pagging['current_page']; ?> of <?php echo $pagging['total_pages']; ?> Pages | <?php echo $pagging['total_item']; echo ($pagging['total_item']>1)?" Requests":" Request"; ?> </div>
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
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade medium" id="show-comments" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Comments From <span></span></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="commnets-wrapper">
							
						</div>
						
					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save</button>
					</div> -->
				</div>
			</div>
		</div>



    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
<?php
require_once(__DIR__.'/../../footer.php');