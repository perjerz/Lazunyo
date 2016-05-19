<?php
session_start();
#-> Include config and class files.
include_once(dirname(dirname(__FILE__)).'/public/includes/config.php');
include_once(dirname(dirname(__FILE__)).'/public/includes/class_mysql.php');
#-> Get data from js and initialize

$data = array('item_name'  => $_POST['name'],
		'item_price' => $_POST['price'],
		'item_img_url' => $_POST['image'],
		'item_description'  => $_POST['description'],
		'item_amount'  => $_POST['qty'],
		'item_owner' => $_SESSION['id']);

#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
$table = 'item';
$addResult = $db->add($table,$data);
if(!$addResult){
	echo "<script type='text/javascript'>alert('Can't add item.');window.location.href = 'add-product.php';</script>";
	#$error['error'] = "Can't add item";
}
#-> Close database.
$db->closedb();
echo "<script type='text/javascript'>alert('Added item successfully.');window.location.href = 'show-product.php';</script>";
?>