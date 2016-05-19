<?php
#-> Include config and class files.
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] >= 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'index.html';</script>";
}
error_reporting(-1);
include_once(dirname(dirname(__FILE__)).'/public/includes/config.php');
include_once(dirname(dirname(__FILE__)).'/public/includes/class_mysql.php');
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
			"password"=> $_POST['password'],
			"fullName"=> $_POST['name'],
			);
	$query = $db->add($table,$data);
}
#-> Prepaing data for return.
$arr = array();
if($query) {
	echo "<script type='text/javascript'>alert('Registered Successfully');window.location.href = 'index.html';</script>";
	/*$arr["status"] = "success";
	$arr["messages"] = "Registered Successfully.";*/
	#header("Location: form-login.html");
} else {
	echo "<script type='text/javascript'>alert('Registered failed. please contact admin.');window.location.href = 'index.html';</script>";
	/*$arr["status"] = "error";
	$arr["messages"] = "Registered failed. please contact admin.";*/	
	#header('Location: ' . $_SERVER['HTTP_REFERER']);
}
#-> Return the data.
#echo json_encode($arr);
#-> Close database.
$db->closedb();
?>