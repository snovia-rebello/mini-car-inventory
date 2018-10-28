<?php
include 'app/Manufacturer.php';
class Model extends Manufacturer{
	private $manufacturer;
	private $db;
	function __construct()
	{
		$this->manufacturer = new Manufacturer();
		$this->db = $this->manufacturer->dbParam();
	}
	
	public function index()
	{
		$mod_name = 'Car Models';
		$data = array();
		$data['manufacturers'] = $this->manufacturer->getAllManufacturers();
		$this->loadView('addModel',$mod_name,$data);
	}
	
	public function saveModel() // to save model details
	{
		$model_name = $_REQUEST['model_name'];
		$manufacturer = $_REQUEST['manufacturer'];

		$model_id = '';
		if($model_name != null && $manufacturer != null)
		{
			// server side validations -- start
			$err_flag = 1;
			if($_REQUEST['reg_no'] == null)
				echo '0|::|Registration Number Cannot be empty';
			else if($_REQUEST['model_color'] == null)
				echo '0|::|Model Color Cannot be empty';
			else if($_REQUEST['manufacturing_year'] == null)
				echo '0|::|Manufacturing year Cannot be empty';
			else if($_REQUEST['model_color'] == null)
				echo '0|::|Model Color Cannot be empty';
			else if(!isset($_FILES['picture1']) || (isset($_FILES['picture1']) && $_FILES['picture1']['name']  == null))
				echo '0|::|Picture 1 must be selected';
			else
				$err_flag = 0;
			
			if(isset($_FILES['picture1']))
			{
				if (strpos($_FILES['picture1']['name'], ".jpg") ||strpos($_FILES['picture1']['name'], ".jpeg") ||strpos($_FILES['picture1']['name'], ".png"))
				{}
				else
				{
					$err_flag = 1;
					echo '0|::|Invalid File for the field Picture 1. Please select a file of type .jpg, .jpeg, .png for Picture 1!';
				}
			}
			
			if(isset($_FILES['picture2']) && $_FILES['picture2']['name'] != null)
			{
				if (strpos($_FILES['picture2']['name'], ".jpg") ||strpos($_FILES['picture2']['name'], ".jpeg") ||strpos($_FILES['picture2']['name'], ".png"))
				{}
				else
				{
					$err_flag = 1;
					echo '0|::|Invalid File for the field Picture 2. Please select a file of type .jpg, .jpeg, .png for Picture 2!';
				}
			}
			// server side validations --- end
			
			if($err_flag == 0)
			{
				$result = $this->db->select("models","deleted='0' AND lower(model_name)='".strtolower($model_name)."' AND manufacturers_manufacturer_id='".$manufacturer."'","model_id");
				
				if($this->db->num_rows($result) == 0) // model is not present in the table
				{
					$insert_arr = array(
						"manufacturers_manufacturer_id" => $manufacturer,
						"model_name" => $this->db->get_mysql_real_escape_string($model_name),
						"added_datetime" => date("Y-m-d H:i:s")
					);
					
					$model_id = $this->db->single_insert('models',$insert_arr);
				}
				else
				{
					$data = $this->db->fetchResultSet($result);
					$model_id = $data[0]['model_id'];
				}
				
				// server side validation to check if registration no exists for same model
				$registration_no = $_REQUEST['reg_no'];
				$result1 = $this->db->select("model_details","deleted='0' AND models_model_id='".$model_id."' AND registration_no='".$registration_no."'","model_details_id");
				
				if($this->db->num_rows($result1) != 0)
					echo '0|::|Model with registration number: '.$registration_no.' is already added!';	
				else
				{
					$picture1=$picture2='';
					$uploaddir = 'images/model_uploads/';
					if(isset($_FILES['picture1']))
					{
						if (strpos($_FILES['picture1']['type'], "docx") || strpos($_FILES['picture1']['name'], ".docx") || strpos($_FILES['picture1']['type'], "doc") || strpos($_FILES['picture1']['name'], ".doc") || strpos($_FILES['picture1']['type'], "pdf") || strpos($_FILES['picture1']['name'], ".pdf") || strpos($_FILES['picture1']['name'], ".gif") ||strpos($_FILES['picture1']['name'], ".jpg") ||strpos($_FILES['picture1']['name'], ".jpeg") ||strpos($_FILES['picture1']['name'], ".png") ||strpos($_FILES['picture1']['name'], ".xlsx") ||strpos($_FILES['picture1']['name'], ".xls") )
						{
							if (is_uploaded_file($_FILES['picture1']["tmp_name"])) 
							{                   
								$nameoffile = "1_".date("YmdHis").$_FILES['picture1']['name'];
								$filepath='expenseAttachments/'.$nameoffile;
								if(move_uploaded_file($_FILES['picture1']["tmp_name"], $uploaddir.$nameoffile))
									$picture1 = $uploaddir.$nameoffile;
							}
						}
					}
					
					if(isset($_FILES['picture2']))
					{
						if (strpos($_FILES['picture2']['type'], "docx") || strpos($_FILES['picture2']['name'], ".docx") || strpos($_FILES['picture2']['type'], "doc") || strpos($_FILES['picture2']['name'], ".doc") || strpos($_FILES['picture2']['type'], "pdf") || strpos($_FILES['picture2']['name'], ".pdf") || strpos($_FILES['picture2']['name'], ".gif") ||strpos($_FILES['picture2']['name'], ".jpg") ||strpos($_FILES['picture2']['name'], ".jpeg") ||strpos($_FILES['picture2']['name'], ".png") ||strpos($_FILES['picture2']['name'], ".xlsx") ||strpos($_FILES['picture2']['name'], ".xls") )
						{
							if (is_uploaded_file($_FILES['picture2']["tmp_name"])) 
							{                   
								$nameoffile = "2_".date("YmdHis").$_FILES['picture2']['name'];
								$filepath='expenseAttachments/'.$nameoffile;
								if(move_uploaded_file($_FILES['picture2']["tmp_name"], $uploaddir.$nameoffile))
									$picture2 = $uploaddir.$nameoffile;
							}
						}
					}
					$insert_arr = array(
						"models_model_id"		=>	$model_id,
						"registration_no"		=>	$this->db->get_mysql_real_escape_string($registration_no),
						"model_color"			=>	$this->db->get_mysql_real_escape_string($_REQUEST['model_color']),
						"manufacturing_year"	=>	$_REQUEST['manufacturing_year'],
						"note"					=>	$this->db->get_mysql_real_escape_string($_REQUEST['note']),
						"picture1"				=>	$picture1,
						"picture2"				=>	$picture2,
						"added_datetime"		=>	date("Y-m-d H:i:s")
					);
					$this->db->single_insert('model_details',$insert_arr);
					echo '1|::|Model Added Successfully!';
				}
			}
		}
		else
			echo '0|::|Model name or Manufacturer cannot be empty!';
	}
	
	public function viewInventory(){ // view to load inventory details
		$mod_name = 'Inventory';
		$html = '<table class="table table-striped" id="modelDetTable">
		<thead>
			<tr>
				<th>Sr No</th>
				<th>Manufacturer Name</th>
				<th>Model Name</th>
				<th>Count</th>
			</tr>
		</thead>
		<tbody>';
		
		$result = $this->db->query("SELECT manufacturers.manufacturer_name, models.model_id, models.model_name, COUNT(model_details.model_details_id) AS cnt FROM manufacturers INNER JOIN models ON manufacturers.manufacturer_id = models.manufacturers_manufacturer_id INNER JOIN model_details ON models.model_id = model_details.models_model_id WHERE manufacturers.deleted='0' AND models.deleted='0' AND model_details.deleted='0' GROUP BY manufacturers.manufacturer_id, models.model_id ORDER BY manufacturer_name");
		
		$data_set = $this->db->fetchResultSet($result);
		$i=1;
		foreach($data_set as $key => $values)
		{
			$html.='<tr onclick="loadModelDetails(\''.$values['model_id'].'\',\''.$values['manufacturer_name'].' - '.$values['model_name'].'\');" style="cursor:pointer;">
				<td>'.$i.'</td>
				<td>'.$values['manufacturer_name'].'</td>
				<td>'.$values['model_name'].'</td>
				<td>'.$values['cnt'].'</td>
			</tr>';
			
			$i++;
		}
		
		$html.='</tbody></table>';
		
		$data = array();
		$data['html'] = $html;
		$this->loadView('inventory',$mod_name,$data);
	}
	
	public function loadModelDetails() // load details of each model in the pop up
	{
		$model_id = $_REQUEST['model_id'];
		$result = $this->db->select("model_details","deleted='0' AND models_model_id='".$model_id."'");
		
		$data = $this->db->fetchResultSet($result);
		
		$html='<div class="row">
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Registration Number</th>
							<th>Model Color</th>
							<th>Registration Number</th>
							<th>Manufacturing Year</th>
							<th>Note</th>
							<th>Pictures</th>
							<th></th>
						</tr>
					</thead>
					<tbody>';
		
		if(count($data) != 0)
		{
			foreach($data as $key => $values)
			{
				$html.='<tr>
					<td>'.$values['registration_no'].'</td>
					<td>'.$values['model_color'].'</td>
					<td>'.$values['registration_no'].'</td>
					<td>'.$values['manufacturing_year'].'</td>
					<td>'.$values['note'].'</td>';
					$pictures = '';
					if($values['picture1'] != null)
					{
						$pic_det = explode("/",$values['picture1']);
						$pic_name = $pic_det[(count($pic_det)-1)];
						$pictures.='<a href="'.$values['picture1'].'" target="_blank">'.$pic_name.'</a>';
					}
					if($values['picture2'] != null)
					{
						$pic_det = explode("/",$values['picture2']);
						$pic_name = $pic_det[(count($pic_det)-1)];
						$pictures.='<br/><a href="'.$values['picture2'].'" target="_blank">'.$pic_name.'</a>';
					}
				$html.='<td>'.$pictures.'</td>
					<td><input type="button" id="markSold" name="markSold" value="Sold" class="btn btn-warning" onclick="markSold(\''.$values['model_details_id'].'\')"/></td>
				</tr>';
			}
		}
		else
			$html.='<tr><td>No Results</td><td></td><td></td><td></td><td></td><td></td></tr>';
		
		$html.='	</tbody>
				</table>
			</div>
		</div>';
		
		echo $html;
	}
	
	public function markSold() // to mark a particular model as sold
	{
		$model_details_id = $_REQUEST['model_detail_id'];
		
		$this->db->query("UPDATE model_details SET deleted='1', deleted_datetime='".date("Y-m-d H:i:s")."' WHERE model_details.model_details_id='".$model_details_id."'");
	}
	
	public function loadView($view_name,$mod_name,$data = array()) // function to load the view
	{
		include 'views/header.php';
		include 'views/'.$view_name.'.php';
		include 'views/footer.php';
	}
}
?>