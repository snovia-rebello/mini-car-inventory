<script src="js/manufacturer.js"></script>
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
	<li class="breadcrumb-item">
	  <a href="#">Car Inventory</a>
	</li>
	<li class="breadcrumb-item active"><?php echo $mod_name;?></li>
  </ol>
	<form method="POST">
		<div class="col-md-12">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 col-sm-12">
					<div class="row">
						<div class="col-md-4">
							<label><font color="red">*</font>Manufacturer Name:</label>
						</div>
						<div class="col-md-8">
							<input type="text" autocomplete="off" id="manufacturer_name" name="manufacturer_name" value="" class="form-control" placeholder="Manufacturer Name"/>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 col-sm-12" id="btDiv">
					<input type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Add Manufacturer"/>
					<input type="hidden" name="module" value="Manufacturer"/>
					<input type="hidden" name="action" value="saveManufacturer"/>
				</div>
			</div>
		</div>
	</form>
	<div class="col-md-12" style="margin-top:50px;">
		<div class="row">
			<div id="dataDiv" style="width:100%;"></div>
		</div>
	</div>
</div>