<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Update Contact</h2>
                <br /><br />
				
				<form role="form" method="POST" action="<?php echo base_url();?>user/update_process">
				
                    <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $fetch->username; ?>" readonly /> <br/>
					
					<label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $fetch->email; ?>" /> <br/>
					
					<label>User Type</label>
                    <input type="text" name="type" class="form-control" value="<?php echo $fetch->user_type; ?>" readonly /> <br/>
					
					</div>
					<input type="hidden" name="id" value="<?php echo $fetch->id; ?>" />
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<br /><br /><br />
				</form>
            </div>
        </div>
</div>