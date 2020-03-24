<style type="text/css">
	.form-group {
		margin-bottom: 0px;
	}
	.form-row>.col, .form-row>[class*=col-] {
	    padding-right: 5px;
	    padding-left: 5px;
	    padding-bottom: 5px;
	}
</style>
<div class="row">
    <div class="col-md-12 p-4">
      	<div class="card">
        	<div class="card-header">
          		Order List
        	</div>
	        <div class="card-body">
	          	<form id="formitem" method="post" action="<?= base_url("order/form");?>">
  					<div id="item_list"></div>
					<br>
  					<button id="dagdag_item" class="btn btn-info" style="margin-right: 10px;">Mag Dagdag ng Item</button>
  					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
	        </div>
	    </div>
    </div>
</div>

<script type="text/javascript">
	var form = '<div class="card">';
	form += '		<div class="card-body">';
	form += '			<div class="form-row">';
	form += '			<div class="form-group col-12 col-md-2">';
	form += '					<input name="qty[]" type="number" class="form-control" placeholder="Piraso" required>';
	form += '			</div>';
	form += '			<div class="form-group col-12 col-md-2">';
	form += '				<select name="sukat[]" required class="form-control">';
	form += '						<option disabled selected>Sukat</option>';
	form += '						<option value="Kilo">Kilo</option>';
	form += '						<option value="Piraso">Piraso</option>';
	form += '						<option value="Lata">Lata</option>';
	form += '						<option value="Tali">Tali</option>';
	form += '						<option value="Balot">Balot</option>';
	form += '						<option value="Bote">Bote</option>';
	form += '					</select>';
	form += '			</div>';
	form += '			<div class="form-group col-12 col-md-7">';
	form += '					<input name="item[]" type="text" class="form-control" placeholder="Item" required>';
	form += '			</div>';
	form += '			<div class="form-group col-12 col-md-1">';
	form += '					<button class="btn btn-danger btn-block btn-remove">X</button>';
	form += '			</div>';
	form += '		</div>';
	form += '	</div>';
	form += '</div>';



	$(document).ready(function() {
	    add_item();
	});

	$(document).on("click", ".btn-remove", function(e){
		e.preventDefault();
		var el = $(this).parent().parent().parent().parent();
		el.remove();
	});


	$(document).on("click", "#dagdag_item", function(e){
		e.preventDefault();
		add_item();
	});

	$("#formitem").validate({
	  submitHandler: function(form) {
	    // do other things for a valid form
	    form.submit();
	  }
	});

	function add_item(){
		$("#item_list").append(form);
	}
</script>