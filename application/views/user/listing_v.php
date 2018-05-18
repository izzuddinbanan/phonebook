<?php
$this->load->view('template/header');
?>
<style>
	.col-sort, .col-sort-asc, .col-sort-desc{
		cursor: pointer;
	}
	
	.col-sort:hover, .col-sort-asc:hover, .col-sort-desc:hover{
		background: #d2d2d2;
		text-decoration: underline;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<h2> &emsp; [ User List ]</h2>
				</div>
				<div class="row">
					<form class="navbar-form pull-right" method="POST" action="">
						<div class="form-group">
							<input type="text" name="search"  class="form-control" value="<?php echo isset($search['search']) ? $search['search'] : ''; ?>" placeholder="Search by Name">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</form>
				</div>
				
				<a href="<?php echo base_url();?>user/create_user"  class="btn btn-primary" >Add user</a>
				<br /><br /><br />
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th class="col-sort<?php echo isset($search['sort_column']) && $search['sort_column'] == 'username' ? '-' . $search['sort_type'] : ''; ?>" data-column="username">Name </th>
								<th class="col-sort<?php echo isset($search['sort_column']) && $search['sort_column'] == 'email' ? '-' . $search['sort_type'] : ''; ?>" data-column="email">Email</th>
								<th class="col-sort<?php echo isset($search['sort_column']) && $search['sort_column'] == 'user_type' ? '-' . $search['sort_type'] : ''; ?>" data-column="user_type">User Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if($listing->num_rows() > 0){
							foreach($listing->result() as $list) {
						?>
							<tr>
								<td><?php echo $list->username; ?></td>
								<td><?php echo $list->email; ?></td>
								<td><?php echo $list->user_type; ?></td>
								<td><a href="<?php echo base_url('user/edit/' .$list->id);?>"  class="btn btn-primary">update</a>
									<a href="<?php echo base_url('user/remove/' .$list->id);?>" class="btn btn-danger">delete</a> 
								</td>
							</tr>
						<?php 
							}
						}
						else {
						?>
							<tr>
								<td colspan="20"> No Record Found</td>
							</tr>
						<?php
						} 
						?>
						</tbody>
						
					</table>
					<?php echo $pagination; ?>
				</div>
				
				<!-- Begin Form For Sorting -->
				<form action="" method="post" class="form-sort">
					<input type="hidden" name="sort_page" class="sort-page" value="<?php echo $this->uri->segment(4); ?>" />
					<input type="hidden" name="sort_column" class="sort-column" value="" />
					<input type="hidden" name="sort_type" class="sort-type" value="" />
				</form>
				<!-- End Form For Sorting -->
			</div>
		</div>
		<!--End Advanced Tables -->
	</div>
</div>
<?php
$this->load->view('template/footer');
?>
<script>
	//On Ready
	$(function(){ //simplify dari $(document).ready(function(){
		
		//Click On Neutral Sort -> ASC Order
		$('.col-sort').on('click', function(){
			//Get Column That User Want to Sort By Clicking .col-sort
			var sorColumn = $(this).data('column');

			//Set Value To be submitted
			$('.form-sort').find('.sort-column').val(sorColumn);
			$('.form-sort').find('.sort-type').val("asc");
			
			//Start Submit
			$('.form-sort').submit();
		});
		
		//Click On Asc Sort -> Desc Order
		$('.col-sort-asc').on('click', function(){
			//Get Column That User Want to Sort By Clicking .col-sort
			var sorColumn = $(this).data('column');
			
			//Set Value To be submitted
			$('.form-sort').find('.sort-column').val(sorColumn);
			$('.form-sort').find('.sort-type').val("desc");
			
			//Start Submit
			$('.form-sort').submit();
		});
		
		//Click On desc Sort -> ASC Order
		$('.col-sort-desc').on('click', function(){
			//Get Column That User Want to Sort By Clicking .col-sort
			var sorColumn = $(this).data('column');
			
			//Set Value To be submitted
			$('.form-sort').find('.sort-column').val(sorColumn);
			$('.form-sort').find('.sort-type').val("asc");
			
			//Start Submit
			$('.form-sort').submit();
		});
	});
</script>


