<?php $this->load->view('template/header'); ?>
<style>
.col-sort, .col-sort-asc, .col-sort-desc{
	cursor: pointer;
}

.col-sort:hover, .col-sort-asc:hover, .col-sort-desc:hover{
	background: #d2d2d2;
}

</style>

<div class="row">
	<div class="col-md-12">
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<h2> &emsp; [ Contact List ]</h2>
				</div>
			
			
				<?php get_message(); ?>
				<div class="row">
					<form class="navbar-form pull-right" method="POST" action="">
						<div class="form-group">
							<input type="text" name="search"  class="form-control" value="<?php echo isset($query_search['search']) ? $query_search['search'] : ''; ?>" placeholder="Search by Name">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" value="Reset" class="btn btn-default">Reset</button>
					</form>
				</div>
				
				<a href="<?php echo base_url();?>contact/form_add"  class="btn btn-primary" >Add Contact</a>
				<br /><br /><br />
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>No</th>
								<th class="col-sort<?php echo isset($query_search['sort-column']) && $query_search['sort-column'] == "name" ? '-'. $query_search['sort-type'] : '' ?> " data-column="name">Name </th>
								<th class="col-sort<?php echo isset($query_search['sort-column']) && $query_search['sort-column'] == "phone" ? '-'. $query_search['sort-type'] : '' ?> " data-column="phone">Phone Number </th>
								<th class="col-sort<?php echo isset($query_search['sort-column']) && $query_search['sort-column'] == "address" ? '-'. $query_search['sort-type'] : '' ?> " data-column="address">address </th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						if($query_list->num_rows() > 0) {
						foreach($query_list->result() as $list) {?>
					   
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $list->name;?></td>
								<td><?php echo $list->phone; ?></td>
								<td><?php echo $list->address; ?></td>
								<td><a href="<?php echo base_url('contact/edit/' .$list->id);?>"  class="btn btn-primary">update</a>
									<a href="<?php echo base_url('contact/remove/' .$list->id);?>" class="btn btn-danger">delete</a> 
								</td>
							</tr>
						
						<?php 
							$i++;
							}
						} 
						else {	
						?>
							<tr>
								<td colspan="20"> No Record Found</td>
							</tr>
						<?php
						} ?>
						</tbody>
					</table>
					<?php echo $pagination; ?>
				</div>
					<!--hidden form for sorting-->
					<form action="" method="post" class="form-sort">
						<input type="hidden" name="sort-page" class="sort-page" value="<?php echo $this->uri->segment(4); ?>" />
						<input type="hidden" name="sort-column" class="sort-column" value="" />
						<input type="hidden" name="sort-type" class="sort-type" value="" />
					</form>
			</div>
		</div>
		<!--End Advanced Tables -->
	</div>
</div>
<?php 
$this->load->view('template/footer');
?>
<script>
	$(function(){
		$('.col-sort').on('click', function(){
			
			var varColumn = $(this).data('column');
			$('.form-sort').find('.sort-column').val(varColumn);
			$('.form-sort').find('.sort-type').val("asc");
			
			$('.form-sort').submit();
		});
		
		$('.col-sort-asc').on('click', function(){
			var varColumn = $(this).data('column');
			$('.form-sort').find('.sort-column').val(varColumn);
			$('.form-sort').find('.sort-type').val("desc");
			
			$('.form-sort').submit();
		});
		
		$('.col-sort-desc').on('click', function(){
			var varColumn = $(this).data('column');
			$('.form-sort').find('.sort-column').val(varColumn);
			$('.form-sort').find('.sort-type').val("asc");
			
			$('.form-sort').submit();
		});
	});
</script>


