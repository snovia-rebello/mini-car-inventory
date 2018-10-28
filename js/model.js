$(document).ready(function(){
	var allowedExtns = ['jpg','jpeg','png'];
	
	if(document.getElementById("modelDetTable"))
	{
		$('#modelDetTable').DataTable( {
				responsive: false
			} );
	}
	if(document.getElementById("manufacturing_year"))
	{
		$('#manufacturing_year').datepicker({
			minViewMode: 'years',
			autoclose: true,
			format: 'yyyy'
		}); 
	}
	
	$('#btnSubmit').on('click',function(){
		$('#btDiv').hide();
		if($('#model_name').val() == '' || $('#model_name').val() == null || ($('#model_name').val().replace(/\s/g, '').length == 0))
		{
			alert("Please enter Model Name!");
			$('#btDiv').show();
			return false;
		}
		else if($('#manufacturer').val() == '')
		{
			alert("Please select Manufacturer!");
			$('#btDiv').show();
			return false;
		}
		else if($('#model_color').val() == '' || $('#model_color').val() == null || ($('#model_color').val().replace(/\s/g, '').length == 0))
		{
			alert("Please enter Model Color!");
			$('#btDiv').show();
			return false;
		}
		else if($('#manufacturing_year').val() == '' || $('#manufacturing_year').val() == null || ($('#manufacturing_year').val().replace(/\s/g, '').length == 0))
		{
			alert("Please select Manufacturing Year!");
			$('#btDiv').show();
			return false;
		}
		else if($('#reg_no').val() == '' || $('#reg_no').val() == null || ($('#reg_no').val().replace(/\s/g, '').length == 0))
		{
			alert("Please enter Registration Number!");
			$('#btDiv').show();
			return false;
		}
		else if($('#picture1').val() == '')
		{
			alert("Please select a file of type .jpg, .jpeg, .png for Picture 1!");
			$('#btDiv').show();
			return false;
		}
		
		if($('#picture1').val() != '' && $('#picture1').val() != null)
		{
			var file_params = $('#picture1').val().split(".");
			var file_ext = file_params[(file_params.length-1)];
			
			if($.inArray(file_ext,allowedExtns) == -1)
			{
				alert("Invalid File for the field Picture 1. Please select a file of type .jpg, .jpeg, .png for Picture 1!");
				$('#btDiv').show();
				return false;
			}
		}
		
		if($('#picture2').val() != '' && $('#picture2').val() != null)
		{
			var file_params = $('#picture2').val().split(".");
			var file_ext = file_params[(file_params.length-1)];
			
			if($.inArray(file_ext,allowedExtns) == -1)
			{
				alert("Invalid File for the field Picture 2. Please select a file of type .jpg, .jpeg, .png for Picture 2!");
				$('#btDiv').show();
				return false;
			}
		}
		
		$.ajax({
			url: "index.php",
			type: "POST",
			data:  new FormData(document.getElementById("model_form")),
			contentType: false,
			cache: false,
			processData:false,
			success: function(result)
			{
				var res = result.split("|::|");
				alert(res[1]);
				
				if(res[0] == 1)
					$("#model_form")[0].reset();
				
				$('#btDiv').show();
			}          
		});
	});
});

function loadModelDetails(model_id, modal_header)
{
	$('#modal_header').html(modal_header);
	$('#modal_body').html('<div align="center"><img src="images/loader.gif"></div>');
	$("#modelDetails").modal();
	$.ajax({
		url: "index.php", 
		async: false,
		type: 'post',
		data: {'module':'Model', 'action': 'loadModelDetails', 'model_id': model_id},
		success: function(result){
			$('#modal_body').html(result);
		}
	});
}

function markSold(model_detail_id)
{
	$.ajax({
		url: "index.php", 
		async: false,
		type: 'post',
		data: {'module':'Model', 'action': 'markSold', 'model_detail_id': model_detail_id},
		success: function(result){
			$("#modelDetails").modal("hide");
			location.reload(); 
		}
	});
}