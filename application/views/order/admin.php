
<div class="row">
    <div class="col-md-12 p-4">
      	<div class="card">
        	<div class="card-header">
          		Barangay <?= @$area;?> Order List 
        	</div>
	        <div class="card-body">
	          	<table class="table table-bordered">
	          		<thead>
	          			<tr>
	          				<th># of pending Orders</th>
	          				<th>As of</th>
	          				<th colspan="2">Action</th>
	          			</tr>
	          		</thead>
	          		<tbody>
	          			<?php if(count($order_list) > 0) { ?>
		          			<tr>
		          				<td><?= $orders;?></td>
		          				<td style="width: 200px;"><?= date("F d,y h:i a");?></td>
		          				<td style="width: 130px;">
		          					<button data-toggle="modal" data-target="#viewlist" class="btn btn-info">View List</button>
		          				</td>
		          				<td style="width: 300px;">
		          					<button id="getorders" class="btn btn-primary">Get Orders and Download slip</button>
		          				</td>
		          			</tr>
		          		<?php } else { ?>
		          			<tr>
		          				<td colspan="4">No pending orders available</td>
		          			</tr>
		          		<?php } ?>
	          		</tbody>
	          	</table>	
	        </div>
	    </div>
    </div>
</div>

<div class="modal fade" id="viewlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Order List</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<table class="table table-bordered">
        			<thead>
        				<tr>
        					<th>Date Order</th>
        					<th>Name</th>
        					<th># Item</th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php foreach ($order_list as $key => $value) {?>
        					<tr>
	        					<td><?= date("F d, y h:i a", strtotime($value->order_date));?></td>
	        					<td><?= $value->name;?></td>
	        					<td><?= count(json_decode($value->order));?></td>
	        				</tr>

        				<?php } ?>
        			</tbody>
        		</table>
      		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
	var downloadurl = "<?= base_url("download-orders/") . $token;?>"
	$(document).on("click", "#getorders", function(e){
		e.preventDefault();
		window.open(downloadurl, '_blank'); 
		setTimeout(
		function(){
			location.reload();
		}, 2000);
	});
</script>