<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view("template/header"); ?>
	<style type="text/css">
		.nav {
		  text-align: center;
		}
	</style>
</head>
<body>
	<div class="container" id="main-wrapper">
		<br>
		<a href="<?= base_url();?>"><center><h3 class="logo"><i class="fa fa-shopping-cart"></i> Pabili.<small>store</small></h3></center></a>


		<div class="col-md-6 offset-md-3 input-group mb-3">
		  	<input id="trackingno" type="text" class="form-control" placeholder="Order No" aria-describedby="basic-addon2">
		  	<div class="input-group-append">
		    	<button class="btn btn-outline-secondary" type="button" id="trackorder">Track Order</button>
		  	</div>
		</div>

		<script type="text/javascript">
			$(document).on("click","#trackorder", function(e){
				var orderno = $("#trackingno").val();
				if(orderno == ""){
					alert("Order Number is required");
				} else {
					window.open("<?= base_url("track/");?>" + orderno, '_self'); 

				}
			});
		</script>

		<?php $this->load->view($content); ?>
	</div>

	<?php $this->load->view("template/footer"); ?>
</body>
</html>