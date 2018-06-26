<?php $this->load->view('template/header'); ?>

<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Update Profile</h2>
                <br /><br />
				
				 <?php  get_message(); ?>
				 
				<form role="form" method="POST" action="" enctype="multipart/form-data">
					<div class="form-group">
						 <img src="<?php echo base_url();?>upload/<?php echo $this->session->userdata('image') == "" ? "blank.png" : $this->session->userdata('image')  ?>" align="center" width="170" height="170">
						<input type="file" name="userfile" size="20" class="form-control"/> <br/>

						<label>Name</label>
						<input type="text" name="username" value="<?php echo $row_user->username; ?>" class="form-control" /> <br/>
						
						<label>email</label>
						<input type="text" name="email" value="<?php echo $row_user->email; ?>" class="form-control"  /> <br/>
						
						<label>Hobby</label>
						<table border="0px" style="width:100%" class="hobby-table">
							<tr>
								<td>
									<input type="text" name="hobi" id="myhobi" value="" class="form-control"  /> 
								</td>
								<td style="width:1%">
									<button type="button" id="btn-delete" class="btn btn-danger" ><span class="fa fa-remove"></span> </button>
								</td>
							</tr>
						</table>
						<br>
						<button type="button" id="addrow" class="btn btn-orange"><span class="fa fa-plus"></span> Add Hobby</button>
						
					</div>
					
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary "/> Back </a>
				</form>
            </div>
        </div>
</div>


<br><br><br><br>

<?php $this->load->view('template/footer'); ?>
<script>
$(function(){
	$('#addrow').on('click', function(){
		$('.hobby-table').append('<tr><td><input type="text" name="hobi" id="myhobi" value="" class="form-control"  /> </td><td style="width:1%"><button type="button" id="btn-delete" class="btn btn-danger" ><span class="fa fa-remove"></span> </button></td></tr>');
	});
	
	$('#btn-delete').on('click', function(){
		// alert(123123);
		if($('.hobby-table tr').length != 1){
			$('.hobby-table tr:last-child').remove();
		}
		// else{
			// $('.hobby-table tr:last-child').attr('disable','disable');
		// }
	});
});
</script>