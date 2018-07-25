<?php $this->load->view('template/header'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<br /><br />
			<h2> Send Mail </h2>
			<br /><br />
			
			<form method="POST" action="" class="form-email" enctype="multipart/form-data">
				<?php get_message(); ?>
				<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($input['email']) ? $input['email'] : ''?>" /> <br>
				
				<label>Message</label>
				<textarea cols="50" rows="15" name="msg" id="msg" class="form-control" value="<?php echo isset($input['msg']) ? $input['msg'] : ''?>" ></textarea> <br>
				
				<label>File attachment </label>
				<input id="file" name="files" type="file" multiple/>
				
				</div>
				<input type="submit" value="Send Email" id="sendmail" name="submit" class="btn btn-primary "/> 
				<br ><br ><br >
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('template/footer'); ?>

