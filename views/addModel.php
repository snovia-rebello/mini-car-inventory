<script src="js/model.js"></script>
    <link href="vendor/datepicker/css/bootstrap-datepicker.css" rel="stylesheet"> 
    <script src="vendor/datepicker/js/bootstrap-datepicker.js"></script> 
<style>
	.row{
		padding: 5px 5px 5px 5px;
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
	<form id="model_form" method="POST" enctype="multipart/form-data">
		<div class="col-md-12">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 col-sm-12">
					<div class="row">
						<div class="col-md-4">
							<label><font color="red">*</font>Model Name:</label>
						</div>
						<div class="col-md-8">
							<input type="text" autocomplete="off" id="model_name" name="model_name" value="" class="form-control" placeholder="Model Name"/>					
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 col-sm-12">
					<div class="row">
						<div class="col-md-4">
							<label><font color="red">*</font>Manufacturer Name:</label>
						</div>
						<div class="col-md-8">
							<select id="manufacturer" name="manufacturer" class="form-control">
								<option value="">Select Manufacturer</option>
								<?php
									if(isset($data['manufacturers']))
									{
										foreach($data['manufacturers'] as $key => $values)
										{
											echo '<option value="'.$values['manufacturer_id'].'">'.$values['manufacturer_name'].'</option>';
										}
									}
								?>
							</select>							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label><font color="red">*</font>Color:</label>
				</div>
				<div class="col-md-8">
					<input type="text" autocomplete="off" id="model_color" name="model_color" value="" class="form-control" placeholder="Model Color"/>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label><font color="red">*</font>Manufacturing Year:</label>
				</div>
				<div class="col-md-8">				
					<input type="text" autocomplete="off" id="manufacturing_year" name="manufacturing_year" value="" class="form-control" placeholder="Manufacturing Year" readonly="readonly"/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label><font color="red">*</font>Registration Number:</label>
				</div>
				<div class="col-md-8">
					<input type="text" autocomplete="off" id="reg_no" name="reg_no" value="" class="form-control" placeholder="Registration Number"/>					
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Note:</label>
				</div>
				<div class="col-md-8">
					<textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label><font color="red">*</font>Picture 1 (.jpg, .jpeg, .png):</label>
				</div>
				<div class="col-md-8">
					<input type="file" id="picture1" name="picture1"/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>Picture 2:</label>
				</div>
				<div class="col-md-8">
					<input type="file" id="picture2" name="picture2"/>					
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-md-6 col-xs-12 col-sm-12"></div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-xs-12 col-sm-12" id="btDiv" align="center" style="text-align:center;">
					<input type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" value="Add Model"/>
					<input type="hidden" name="module" value="Model"/>
					<input type="hidden" name="action" value="saveModel"/>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-xs-12 col-sm-12"></div>
			</div>
		</div>
	</form>
</div>