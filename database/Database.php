<?php
class Database{
	
	private $server, $username, $password,$database;
	function __construct()
	{
		$this->server = 'localhost';
		$this->username = 'root';
		$this->password = '';
		$this->database = 'car_inventory';
	}
	
	public function connect() // function to connect and select db
	{
		mysql_connect($this->server,$this->username,$this->password) or die('DB Connection Failed!'.mysql_error());
		mysql_select_db($this->database) or die('DB Selection Failed!'.mysql_error());
	}
	
	public function single_insert($table_nm, $db_arr) // function to perform insert operation
	{
		mysql_query("INSERT INTO ".$table_nm."(".implode(",",array_keys($db_arr)).") VALUES('".implode("','",array_values($db_arr))."')") or die('Insert Failed -- '.mysql_error());
		
		return mysql_insert_id();
	}
	
	public function select($table_nm, $where_cond = null, $select_params = null)// function to perform select operation
	{
		if($where_cond != null)
			$where_cond = " WHERE ".$where_cond;
		
		if($select_params == null)
			$select_params = '*';
		
		$result = mysql_query("SELECT ".$select_params." FROM ".$table_nm.$where_cond) or die("Select Failed -- ".mysql_error());
		return $result;
	}
	
	public function query($query)// function to run a query
	{
		$query_result = mysql_query($query) or die('Query Failed -- '.mysql_error());
		
		return $query_result;
	}
	
	public function fetchResultSet($query_result)// function to pass the result set of the query that was run
	{
		$result_set = array();
		while($row = mysql_fetch_assoc($query_result))
		{
			array_push($result_set,$row);
		}
		return $result_set;
	}
	
	public function num_rows($query_result)// function to return num rows of an executed query
	{
		return mysql_num_rows($query_result);
	}
}
?>