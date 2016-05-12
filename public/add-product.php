<?php
#-> Include config and class files.
include_once('includes/config.php');
include_once('includes/class_mysql.php');
#-> Get data from js and initialize

$data = array('item_name'  => $_POST['name'],
		'item_price' => $_POST['price'],
		'item_img_url' => $_POST['image'],
		'item_description'  => $_POST['description'],
		'item_amount'  => $_POST['qty'],
		#$data['owner'] = $_SESSION['username'];
		'item_owner' => 'Dummy Dummer');

#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
$table = 'item';
$addResult = $db->add($table,$data);
if(!$addResult){
	$error['error'] = "Can't add item";
}
#-> Close database.
$db->closedb();
?>