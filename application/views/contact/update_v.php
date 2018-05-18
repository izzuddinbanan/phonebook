<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Update Contact</h2>
                <br /><br />
				
				<form role="form" method="POST" action="<?php echo base_url();?>contact/update_process">
				
                    <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $fetch->name; ?>" readonly/> <br/>
					
					<label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $fetch->phone; ?>" /> <br/>
					
					<label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $fetch->address; ?>" /> <br/>
					
					</div>
					<input type="hidden" name="id" value="<?php echo $fetch->id; ?>" />
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>contact/contactpage" class="btn btn-primary "/> Back </a>
					
				</form>
            </div>
        </div>
</div>