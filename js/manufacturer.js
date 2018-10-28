$(document).ready(function(){
	
	loadAllManufacturers();
	
	$('#btnSubmit').on('click',function(){
		$('#btDiv').hide();
		if($('#manufacturer_name').val() == '' || $('#manufacturer_name').val() == null || ($('#manufacturer_name').val().replace(/\s/g, '').length == 0))
		{
			alert("Please enter Manufacturer Name!");
			$('#btDiv').show();
			return false;
		}
		else
		{
			var formData = $('form').serialize();
			$.ajax({
				url: "index.php", 
				async: false,
				type: 'post',
				data: formData,
				success: function(result){
					if(result == 1)
					{
						alert("Manufacturer Added Successfully!");
						$('#manufacturer_name').val('');
						loadAllManufacturers();
					}
					else if(result == 2)
					{
						alert("Manufacturer "+$('#manufacturer_name').val()+" is already added!");
						$('#manufacturer_name').val('')
						loadAllManufacturers();
					}
					else
					{
						alert("Some error occurred when adding a new manufacturer! Please try again later!");
						$('#btDiv').show();
					}
				}
			});
		}
	});
});

function loadAllManufacturers()
{
	$('#btDiv').hide();
	$('#dataDiv').html('<div align="center"><img src="images/loader.gif"></div>');
	$.ajax({
		url: "index.php?module=manufacturer&action=loadAllManufacturers", 
		async: false,
		success: function(result){
			$("#dataDiv").html(result);
			$('#manufacturers_table').DataTable( {
				responsive: false
			} );
    }});
	
	$('#btDiv').show();
}