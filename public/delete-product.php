<?php
session_start();
#-> Include config and class files.
include_once("/includes/config.php");
include_once("/includes/class_mysql.php");
#-> Get data from js and initialize
#$data = file_get_contents("php://input");
#$json = json_decode($data);
#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
//DELETE COMPANY TABLE 
$table = TB_ITEM;
$id = $_GET['id'];
$where = "item_id=$id";
$query = $db->delete($table,$where);
#-> Preparing the data for return.
$arr = array();
if($query) {
	$arr["status"] = "success";
	$arr["messages"] = "Delete company successfully";
	echo "<script type='text/javascript'>window.location.href = 'show-product.php';</script>";#$messages = "Please enter your 
} else {
	$arr["status"] = "error";
	$arr["messages"] = "Failed to delete";
}
#-> Return the data.
echo json_encode($arr);
		 
#-> Close database.
$db->closedb();
?>