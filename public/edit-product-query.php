<?php
session_start();
#-> Include config and class files.
include_once(dirname(dirname(__FILE__)).'/public/includes/config.php');
include_once(dirname(dirname(__FILE__)).'/public/includes/class_mysql.php');
#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);

$id = $_SESSION['id'];
$table = TB_ITEM;
$where = "item_id= $id";
$data = array('item_name'  => $_POST['name'],
		'item_price' => $_POST['price'],
		'item_img_url' => $_POST['image'],
		'item_description'  => $_POST['description'],
		'item_amount'  => $_POST['qty']);
$query = $db->update($table,$data,$where);
#-> Preparing the data for return.
$arr = array();
if($query) {
	#$arr["status"] = "success";
	#$arr["messages"] = "Edit product successfully";
	echo "<script type='text/javascript'>alert('Update product successfully.');window.location.href = 'show-product.php';</script>";#$messages = "Please enter your 
} else {
	echo "<script type='text/javascript'>alert('Update product failed.');window.location.href = 'show-product.php';</script>";
	#$arr["status"] = "error";
	#$arr["messages"] = "Failed to delete";
}
#-> Return the data.
#echo json_encode($arr);	 
#-> Close database.
$db->closedb();
?>