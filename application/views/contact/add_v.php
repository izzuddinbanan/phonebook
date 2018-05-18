<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Add User</h2>
                <br /><br />
				
				 <?php get_message(); ?>
				<form role="form" method="POST" action="">
				
                    <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($post_data->name) ? $post_data->name : ''; ?>" /> <br/>
					
					<label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo isset($post_data->phone) ? $post_data->phone : ''; ?>" /> <br/>
					
					<label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo isset($post_data->address) ? $post_data->address : ''; ?>" /> <br/>
					
					</div>
					
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>contact/contactpage" class="btn btn-primary "/> Back </a>
					
				</form>
            </div>
        </div>
</div>


<br><br><br><br>