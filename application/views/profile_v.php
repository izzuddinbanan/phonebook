<?php $this->load->view('template/header'); ?>

<div class="container">
	<div class="row ">
		<div class="col-md-12">
			<br /><br />
			<h2>Update Profile</h2>
			<br /><br />
			
			<?php  get_message();
			$i = 1;
			?>
			
			<form role="form" method="POST" action="" enctype="multipart/form-data">
				<div class="form-group">
					<img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('image') == "" ? "" : $this->session->userdata('image')  ?>" align="center" width="170" height="170">
					<input type="file" name="userfile" size="20" class="form-control"/>
				</div>
				
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="username" value="<?php echo $row_user->username; ?>" class="form-control" /> 
				</div>
					
				<div class="form-group">
					<label>email</label>
					<input type="text" name="email" value="<?php echo $row_user->email; ?>" class="form-control"  /> 
				</div>
					
				<div class="form-group">
					<label>Hobby</label>
					<table class="table table-bordered table-hover hobby-table" style="margin-bottom: 5px;">
						<thead>
							<tr>
								<th style="width:1%">
									No.
								</th>
								<th>
									Name
								</th>
								<th style="width:1%">
									&nbsp;
								</th>
							</tr>
						</thead>
						<tbody class="div-hobby">
							<tr class="row-hobby">
								<td class="hobby-number">1</td>
								<td>
									<input type="text" name="hobi[]" value="" class="hobi form-control" value="" /> 
								</td>
								<td>
									<button type="button" class="btn-delete-row btn btn-danger"><span class="fa fa-remove"></span></button>
								</td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn-add-row btn btn-success form-control"><span class="fa fa-plus"></span> Add Hobby</button>
				</div>
				
				<div class="form-group">
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary "/> Back </a>
				</div>
			</form>
		</div>
	</div>
</div>


<br><br><br><br>

<?php $this->load->view('template/footer'); ?>
<script>
var renumbering = function(){
	$.each($('.hobby-number'), function(key, elem){
		$(elem).html(key + 1);
	});
}

$(function(){
	$('.btn-add-row').on('click', function(){
		var newRow = $($('.row-hobby')[0]).clone();
		newRow.find('.hobi').val("");
		
		$('.div-hobby').append(newRow);
		renumbering();
	});
	
	$('body').on('click', '.btn-delete-row', function(){
		if($('.row-hobby').length != 1){
			$(this).closest('.row-hobby').remove();
			renumbering();
		}
	});
	
	$(".btn-add-row").die( "click");
});
</script>