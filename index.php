<?php
ini_set("display_errors",0);

//module -- is the name of the class
// action -- is the name of the method of the respective class

if(isset($_REQUEST['module']) && $_REQUEST['module'] != null)
	$module = ucfirst(strtolower($_REQUEST['module']));
else
	$module = 'Manufacturer';

$action = 'index';
if(isset($_REQUEST['action']) && $_REQUEST['action'] != null)
	$action = $_REQUEST['action'];

include 'database/Database.php';
include 'app/'.$module.'.php';
$obj = new $module(); // creating the object of the class

$obj->$action(); // calling the method of the class
?>