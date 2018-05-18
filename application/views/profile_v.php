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
						
					</div>
					
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary "/> Back </a>
				</form>
            </div>
        </div>
</div>


<br><br><br><br>

<?php $this->load->view('template/footer'); ?>