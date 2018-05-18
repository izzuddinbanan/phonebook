<div class="container">
        <div class="row ">
            <div class="col-md-12">
                <br /><br />
                <h2>Create User</h2>
                <br /><br />
				<?php get_message() ?>
				<form role="form" method="POST" action="">
				
                    <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user" class="form-control" required/> <br/>
					
					<label>Password</label>
                    <input type="text" name="password" class="form-control" required/> <br/>
					
					<label>Email</label>
                    <input type="text" name="email" class="form-control" required/> <br/>
					
					<label>User Type</label>
					<select name="type" class="form-control">
					<option value="admin">Admin</option>
					<option value="user">User</option>
					</select>
					
                    </div>
					
					<input type="submit" value="Save" name="submit" class="btn btn-primary "/>
					<a href="<?php echo base_url(); ?>dashboard" class="btn btn-primary "/> Back </a>
					
				</form>
            </div>
        </div>
</div>

<br><br><br><br>