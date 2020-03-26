<div class="row">
	<div class="col-md-4 p-4">
		<div class="card">
        	<div class="card-header">
          		Shopping List
        	</div>
        	<div class="card-body">
        		<?php 
					$order_list = json_decode($this->session->userdata('order_list'));
					foreach ($order_list as $key => $value) {
						echo "<li>" . $value->qty . " " . $value->sukat . " " . $value->item . "</li>";
					}


					$item_count = count($order_list);
					$service_top = 20;
					$transportation = 30;
					$total = $transportation + $service_top;
				?>
				<hr>
				<strong>Delivery Fee : </strong><span class="float-right">₱ <?= number_format($transportation, 2);?></span><br />
				<strong>Service Tip : </strong><span class="float-right">₱ <?= number_format($service_top, 2);?></span><hr>
				<strong>TOTAL : <span class="float-right">₱ <?= number_format($total, 2);?></span> </strong><br><br>
				<strong>PAALALA</strong>
				<li>Ang presyo ng inyong ipapamili ay hindi sakop sa computation na ito. bukod ninyong ibibigay sa PROVIDER ang pang bili ng inyong mga pangangailangan pag punta sa inyong tahanan.</li><br>
				<li>Ibigay lamang ang Service Tip at Transportation fee kapag naibigay na ang inyong napamili.</li>
        	</div>
        </div>
	</div>
    <div class="col-md-8 p-4">
      	<div class="card">
        	<div class="card-header">
          		Contact Information
        	</div>
	        <div class="card-body">
	          	<form id="formitem" method="post" action="<?= base_url("order/submit");?>">
	  				<div class="form-row">
	    				<div class="form-group col-12 col-md-6">
	      					<label>* Pangalan</label>
	      					<input name="pangalan" type="text" class="form-control" placeholder="Buong Pangalan" required>
	    				</div>
	    				<div class="form-group col-12 col-md-6">
	      					<label>* Contact No.</label>
	      					<input name="contactno" type="text" class="form-control" placeholder="Contact Number" required>
	    				</div>
	    				<div class="form-group col-12 col-md-12">
	      					<label>* Lugar / Barangay</label>
	      					<select name="lugar" class="form-control" required>
	      						<?php foreach ($lugar as $key => $value) { ?>
	      							<optgroup label="<?= $value['Town'];?>"/></optgroup>
	      							<?php foreach ($value['Brgy'] as $k => $v) { ?>
	      								<option value="<?= $v->id;?>">&nbsp; &nbsp; <?= $v->area; ?></option>
	      							<?php }?>
	      						<?php } ?>
	      					</select>
	    				</div>
	    				<div class="form-group col-12 col-md-12">
	      					<label>* Kumpletong Address</label>
	      					<textarea name="address" class="form-control" rows="5" required></textarea>
	    				</div>
	  					<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
				
	        </div>
	    </div>
    </div>
</div>

<script type="text/javascript">
	$("#formitem").validate({
	  submitHandler: function(form) {
	    // do other things for a valid form
	    form.submit();
	  }
	});
</script>