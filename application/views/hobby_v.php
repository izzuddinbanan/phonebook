<?php
$this->load->view('template/header');
?>

<div class="row">
	<div class="col-md-12">
		<!-- Advanced Tables -->
		<div class="panel panel-default">
			<div class="panel-body">
				<br /><br /><br />
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Hobby </th>
								<th>Description</th>
								<th>Action</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input type="text" name="name" /></td>
								<td><input type="text" name="hobi" /></td>
								<td><button type="submit" id="remove" class="btn btn-primary">Delete</button></td>
							</tr>
						</tbody>
					</table>
					<button type="submit" id="add_row" class="btn btn-primary">add</button>
				</div>
			</div>
		</div>
		<!--End Advanced Tables -->
	</div>
</div>
<?php $this->load->view('template/footer'); ?>

<script>
	$(function(){
		$('#add_row').on('click', function(){
			var row = '<tr><td><input type="text" name="name" /></td><td><input type="text" name="hobi" /></td><td><button type="submit" id="remove" class="btn btn-primary">Delete</button></td></tr>';
			$('table tbody').append(row);
		});
		
		$('#remove').on('click',function(){
			$(this).parent('tr').remove();
		});
	});

</script>


