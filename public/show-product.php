<?php
#-> Include config and class files.
include_once("/includes/config.php");
include_once("/includes/class_mysql.php");
#-> Get data from js and initialize
#$data = file_get_contents("php://input");
#$json = json_decode($data);
#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
#-> Query the data.
$query = $db->querydb("SELECT item_id,item_name,item_price,item_img_url,item_description,item_amount,item_likes_count FROM ".TB_ITEM." WHERE item_owner ="."0".";");
#-> Preparing return data.
$i =0;
$arr = array();
if($query){
	echo "<table border='1' style='width:50%'><tr><td>No.</td><td>ID</td><td>Name</td><td>Price</td><td>Image</td><td>Description</td><td>Amount</td><td>Likes</td><td>Option</td></tr>";
	while($itemData = $db->fetchAssoc($query)){
		echo "<tr><td>".$i."</td>";
		foreach ($itemData as $value) {
			echo "<td>".$value."</td>";
		 }
		 echo "<td><a href="."delete-product.php?id={$itemData['item_id']}>Delete</a></td>";
		 echo "</tr>";
/*$itemData["item_id"].$itemData["item_id"];
$itemData["item_name"];
$itemData["item_price"];
$itemData["item_img_url"];
$itemData["item_description"];
$itemData["item_amount"];
 $itemData["item_likes_count"]*/
		$i++;
	}
	echo "</table>";
}else{
	$arr["status"] = "error";
	$arr["messages"] = "Error occured when you query the data to item table.";
	echo json_encode($arr);
	exit();
}
$arr["status"] = "success";
$arr["messages"] = "success query all items";
#-> Return json data.
echo json_encode($arr,JSON_NUMERIC_CHECK);
#-> Close database.
$db->closedb();
?>