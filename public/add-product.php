<?php
#-> Include config and class files.
include_once("includes/config.php");
include_once("includes/class_mysql.php");
#-> Get data from js and initialize


$data["name"]  = $_GET["name"];
$data["price"]  = $_GET["price"];
$data["image"]  = $_GET["image"];
$data["description"]  = $_GET["description"];
$data["qty"]  = $_GET["qty"];
#$data["owner"] = $_SESSION['username'];
$data["owner"] = "Dummy Dummer";

#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
$table = "Item";
$addResult = $db->add($table,$data);
if(!$addResult){
	$error["error"] = "Can't add item";
}

#-> Close database.
$db->closedb();
?>