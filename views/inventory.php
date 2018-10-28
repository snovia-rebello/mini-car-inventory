<script src="js/model.js"></script>
<style>
.modal-lg {
		max-width: 1000px !important;
	}
</style>
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="#">Car Inventory</a>
	</li>
	<li class="breadcrumb-item active"><?php echo $mod_name;?></li>
  </ol>
	<div class="col-md-12">
		<div class="row">
			<div id="dataDiv">
				<?php
					if(isset($data['html']))
						echo $data['html'];
				?>
			</div>
		</div>
	</div>
	<div id="modelDetails" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="modal_header"></h4>
		  </div>
		  <div class="modal-body" id="modal_body">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
</div>