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
		<center><h3 class="logo"><i class="fa fa-shopping-cart"></i> Pabili.<small>store</small></h3></center>
<!-- 		<nav class="nav">
		  	<a class="nav-link" href="#">Home</a>
		  	<a class="nav-link" href="#">Track Order</a>
		  	<a class="nav-link" href="#">Contact Us</a>
		  	<a class="nav-link" href="#">About Us</a>
		</nav> -->
		<?php $this->load->view($content); ?>
	</div>

	<?php $this->load->view("template/footer"); ?>
</body>
</html>