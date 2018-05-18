		<style>
		  .bg-1 { 
			  background-color: #1abc9c; /* Green */
			  color: #ffffff;
		  }
		  .footer {
			clear: both;
			position: relative;
			z-index: 10;
		   
			margin-top: -3em;
			}
		</style>

		<div class="footer container-fluid bg-1 text-center">
			<h3>Who Am I?</h3>
				<img src="<?php echo base_url();?>assets/image/rooney.jpg" width="100" height="100" class="img-circle" alt="Bird">
			<h3></h3>
		</div>


		<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
		<!-- JQUERY SCRIPTS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
		<!-- BOOTSTRAP SCRIPTS -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
		<!-- METISMENU SCRIPTS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
		<!-- CUSTOM SCRIPTS -->
		<script src="<?php echo base_url();?>assets/js/custom.js?v=" . time() ></script>
		<script>
		
			//Initiate sorting view
			var initSorting = function(){
				$('.col-sort').append(' <i class="fa fa-sort"></i>');
				$('.col-sort-asc').append(' <i class="fa fa-sort-asc"></i>');
				$('.col-sort-desc').append(' <i class="fa fa-sort-desc"></i>');
			}
			
			//Initiate Sorting Style
			$(function(){
				initSorting();
			});
		</script>
	</body>
</html>