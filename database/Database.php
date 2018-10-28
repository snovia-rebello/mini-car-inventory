<?php
class Database{
	
	private $conn;
	function __construct()
	{
		$this->conn = mysqli_connect('localhost','root','') or die('DB Connection Failed!');
		mysqli_select_db($this->conn,'car_inventory') or die('DB Selection Failed!'.mysqli_error($this->conn));
	}
	
	public function single_insert($table_nm, $db_arr) // function to perform insert operation
	{
		mysqli_query($this->conn,"INSERT INTO ".$table_nm."(".implode(",",array_keys($db_arr)).") VALUES('".implode("','",array_values($db_arr))."')") or die('Insert Failed -- '.mysqli_error($this->conn));
		
		return mysqli_insert_id($this->conn);
	}
	
	public function select($table_nm, $where_cond = null, $select_params = null)// function to perform select operation
	{
		if($where_cond != null)
			$where_cond = " WHERE ".$where_cond;
		
		if($select_params == null)
			$select_params = '*';
		
		$result = mysqli_query($this->conn,"SELECT ".$select_params." FROM ".$table_nm.$where_cond) or die("Select Failed -- ".mysqli_error($this->conn));
		return $result;
	}
	
	public function query($query)// function to run a query
	{
		$query_result = mysqli_query($this->conn,$query) or die('Query Failed -- '.mysqli_error($this->conn));
		
		return $query_result;
	}
	
	public function fetchResultSet($query_result)// function to pass the result set of the query that was run
	{
		$result_set = array();
		while($row = mysqli_fetch_assoc($query_result))
		{
			array_push($result_set,$row);
		}
		return $result_set;
	}
	
	public function num_rows($query_result)// function to return num rows of an executed query
	{
		return mysqli_num_rows($query_result);
	}
	
	public function get_mysql_real_escape_string($str)
	{
		return mysqli_real_escape_string($this->conn,$str);
	}
}
?>