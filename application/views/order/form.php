<div class="row">
    <div class="col-md-12 p-4">
      	<div class="card">
        	<div class="card-header">
          		Order Information
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
	      					<select name="lugar" class="form-control">
	      						<option disabled selected>Select..</option>
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
	      					<textarea name="address" class="form-control" rows="5"></textarea>
	    				</div>
	    				<div class="form-group col-12 col-md-12">
	      					<label>* Order List</label>
	      					<ul>
								<?php 
									$order_list = json_decode($this->session->userdata('order_list'));
									foreach ($order_list as $key => $value) {
										echo "<li>" . $value->qty . " " . $value->sukat . " = " . $value->item . "</li>";
									}
								?>
							</ul>
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