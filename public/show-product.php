<?php
session_start();
if(!isset($_SESSION['id']) || $_SESSION['id'] < 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'form-login.html';</script>";
}
?>
<script>
function confirmDelete()
{
  var x = confirm("Are you sure you want to delete?");
  if (x)
      return true;
  else
    return false;
}
function logout()
{
 window.location.assign("logout.php");
}
</script>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lazunyo | Seller Inventory </title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

</head>
<body>
    <header>
        <h1>Lazunyo - Inventory Management</h1>
        <h2 onclick="logout()">Logout</h2>
    </header>

    <ul>
        <li><a href="show-product.php">Product Info</a></li>
        <li><a href="add-product.php"><!--class="active"-->Add</a></li>
        <!--li><a href="edit-product.html">Edit</a></li-->
    </ul>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="#">

            <div class="form-title-row">
                <h1>Show Product</h1>
            </div>
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
                $query = $db->querydb("SELECT item_id,item_name,item_price,item_img_url,item_description,item_amount,item_likes_count FROM ".TB_ITEM." WHERE item_owner =".$_SESSION['id'].";");
                #-> Preparing return data.
                $i =0;
                $arr = array();
                if($query){
                    echo "<table border='1' style='width:100%'><tr><td>No.</td><td>ID</td><td>Name</td><td>Price</td><td>Image</td><td>Description</td><td>Amount</td><td>Likes</td><td>Delete</td><td>Edit</td></tr>";
                    while($itemData = $db->fetchAssoc($query)){
                        echo "<tr><td>".$i."</td>";
                        foreach ($itemData as $value) {
                            echo "<td>".$value."</td>";
                         }
                         echo "<td><a href="."delete-product.php?id={$itemData['item_id']} onclick='return confirmDelete();'>Delete</a></td>";
                         echo "<td><a href="."edit-product.php?id={$itemData['item_id']}>Edit</a></td>";
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
                #-> Close database.
                $db->closedb();
                ?>
        </form>

    </div>

</body>

</html>
