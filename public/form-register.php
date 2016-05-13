<?php
#-> Include config and class files.
include_once("/includes/config.php");
include_once("/includes/class_mysql.php");
#-> Get data from js and initialize
#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
//ADD COMPANY TABLE 
if((strlen($_POST['name']) == 0)||($_POST['email']==null) || ($_POST['password']==null))
{
	$query = false;
} else {
	$table = 'user';
	$data = array("username"=> $_POST['email'],
			"password"=> $_POST['email'],
			"fullName"=> $_POST['name'],
			);
	$query = $db->add($table,$data);
}
#-> Prepaing data for return.
$arr = array();
if($query) {
	$arr["status"] = "success";
	$arr["messages"] = "Registered Successfully.";
} else {
	$arr["status"] = "error";
	$arr["messages"] = "Registered failed. please contact admin.";
}
#-> Return the data.
echo json_encode($arr);
#-> Close database.
$db->closedb();
?>