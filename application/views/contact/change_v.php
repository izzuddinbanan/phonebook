<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Change Password</h2>
                <br /><br />
				
				 <?php  get_message(); ?>
				 
				<form role="form" method="POST" action="<?php echo base_url();?>contact/change_pwd">
					<div class="form-group">
						<label>Old Password</label>
						<input type="password" name="old" class="form-control" /> <br/>
						
						<label>New Password</label>
						<input type="password" name="new" class="form-control"  /> <br/>
						
						<label>Confirm New Password</label>
						<input type="password" name="confirm" class="form-control" /> <br/>
					</div>
					
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary "/> Back </a>
				</form>
            </div>
        </div>
</div>


<br><br><br><br>