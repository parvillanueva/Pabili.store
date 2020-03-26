<div class="row">
    <div class="col-md-12 p-4">
      	<div class="card">
        	<div class="card-header">
          		Check Order
        	</div>
	        <div class="card-body">
	          	<div>
	  				<div class="">
	    				<center>

	    					<?php if (count($order_details) > 0 ) { ?> 

	    					<h4>Order no.</h4>
	    					<h2><?= $orderno;?></h2>
	    					<br />
	    					<h4>Status</h4>

	    					<?php  switch ($order_details[0]->status) {
	    						case 0:
	    							echo '	<h2 style="color: burlywood;">Pending</h2>
					    					<label>Ang iyong pabili ay Pending at maghintay lamang po sa aming cutoff na tuwing 6AM ng umaga para maprocess ang Order na ito.</label>
					    					<br /><br />';
	    							break;
	    						case 1:
	    							echo '	<h2 style="color: cadetblue;">Ongoing</h2>
					    					<label>Kasalukuyang inaayos at binibili na po ang iyong Order</label>
					    					<br /><br />';
	    							break;
	    						case 2:
	    							echo '	<h2 style="color: greenyellow;">Complete</h2>
					    					<label>Ang inyong mga Pabili ay Tapos na at naideliver na sa inyo</label>
					    					<br /><br />';
	    							break;
	    						case -2:
	    							echo '	<h2 style="color: red;">Canceled</h2>
					    					<label>Ang inyong mga Pabili ay kanselado</label>
					    					<br /><br />';
	    							break;
	    						
	    					}  


	    					


	    					if($order_details[0]->status != 2){
								echo '<label>Paalaala : Hindi na maaring iCancel ang Order kapag ang Status ay <b>Ongoing</b>.</label><br>';
	    					}
	    					if($order_details[0]->status == 0){
	    						echo '<a href="#" id="cancelorder" class="btn btn-danger">Cancel Order</a>';
	    					}
	    					?>

	    				<?php } else { ?>
	    					<h4>Order no. not found.</h4>
	    				<?php } ?>
	    					
	    					

	  						
	    				</center>
					</div>
				</div>
	        </div>
	    </div>
    </div>
</div>

<script type="text/javascript">
	$(document).on("click", "#cancelorder", function(e){
		e.preventDefault();
		var orderno = "<?= $orderno;?>";
		var url = "<?= base_url("cancel-order/");?>" + orderno;
		$.get(url, function(data, status){
		    location.reload();
		});
		
	});
</script>