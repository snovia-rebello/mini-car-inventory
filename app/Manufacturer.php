<?php
class Manufacturer extends Database{
	private $db;
	function __construct()
	{		
		$this->db = new Database();
	}
	
	public function dbParam()// to return the db parameter
	{
		return $this->db;
	}
	public function index()
	{
		$mod_name = 'Manufacturers';
		$this->loadView('addManufacturer',$mod_name);
	}
	
	public function loadAllManufacturers(){ // load all manufacturers in a listing
		$html = '<table id="manufacturers_table" class="table table-striped">';
		$html.= '<thead>
			<tr>
				<th>Sr No</th>
				<th>Manufacturer Name</th>
				<th>Added on</th>
			</tr>
		</thead>
		<tbody>';
		
		$data = $this->getAllManufacturers();
		
		$i=1;
		if(count($data) != 0)
		{
			foreach($data as $ind => $rows)
			{
				$html.='<tr><td>'.$i.'</td><td>'.$rows['manufacturer_name'].'</td><td>'.$rows['added_datetime'].'</td></tr>';
				$i++;
			}
		}
		else
			$html.='<tr><td>No Results Found</td><td></td><td></td></tr>';
		
		$html.='</tbody>';
		$html.='</table>';
		
		echo $html;
	}
	
	public function saveManufacturer() // to save manufacturer
	{
		$manufacturer_name = $_REQUEST['manufacturer_name'];
		if($manufacturer_name != null)
		{
			$result = $this->db->select("manufacturers","lower(manufacturer_name) = '".strtolower($manufacturer_name)."'","manufacturer_id");
			
			if($this->db->num_rows($result) == 0)
			{
				$insert_arr = array(
					"manufacturer_name" => $this->db->get_mysql_real_escape_string($manufacturer_name),
					"added_datetime" => date("Y-m-d H:i:s")
				);
				
				$this->db->single_insert('manufacturers',$insert_arr);
				
				echo 1;
			}
			else
				echo 2;
		}
		else
			echo 0;
	}
	
	public function getAllManufacturers() // function to getthe manufactuerers from db
	{
		$result = $this->db->select("manufacturers","deleted='0'");
		$data = array();
		if($this->db->num_rows($result) != 0)
			$data = $this->db->fetchResultSet($result);
		
		return $data;
	}
	
	public function loadView($view_name,$mod_name,$data = array()) // function to load view
	{
		include 'views/header.php';
		include 'views/'.$view_name.'.php';
		include 'views/footer.php';
	}
}
?>