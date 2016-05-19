<?php
session_start();
if(!isset($_SESSION['id']) || $_SESSION['id'] < 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'index.html';</script>";
}
error_reporting(E_ALL ^ E_DEPRECATED);
#-> Connect to the database
include_once(dirname(dirname(__FILE__)).'/public/includes/config.php');
include_once(dirname(dirname(__FILE__)).'/public/includes/class_mysql.php');
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
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

    <link rel="stylesheet" href="assets/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand ">
            <p class="animated bounceIn">
                Lazunyo
            </p>
        </div>
        <div class="sidebar-tab">
            <div class="tab-section">
                <ul class="menu-list">
                    <p class="topic">user</p>
                    <a ui-sref="profile" ui-sref-active="active" class="menu-item menu-user">
                        <div style="background-image:url('./assets/profile.png'); background-size:cover; border-size: 0px" class="profile-img"></div>
                        <div class="profile-detail">
                            <?php 

                            $query = $db->querydb("SELECT * FROM ".TB_USER." WHERE user_id =".$_SESSION['id'].";");
                            $user = $db->fetchAssoc($query);
                            ?>
                            <div class="user-name">
                                <?php
                                echo $user["fullName"];
                                ?>
                            </div>
                        </div>
                    </a>
                </ul>
            </div>
            <div class="tab-section">
                <ul class="menu-list">
                    <p class="topic">menu</p>
                    <a href="show-product.php" class="menu-item"><i class="fa fa-list-alt"></i> All Product</a>
                    <a href="add-product.php" class="menu-item"><i class="fa fa-plus"></i> Add New Product</a>
                </ul>
            </div>
        </div>
    </div>

        <div class="content animated fadeIn">
            <div class="container">

        <!-- You only need this form and the form-basic.css -->

            <div class="form-title-row">
                <h1>Show Product</h1>
            </div>
            <?php
                #-> Include config and class files.
               
                #-> Query the data.
                $query = $db->querydb("SELECT item_id,item_name,item_price,item_img_url,item_description,item_amount,item_likes_count FROM ".TB_ITEM." WHERE item_owner =".$_SESSION['id'].";");
                #-> Preparing return data.
                $i =0;
                $arr = array();
                if($query){
                    echo"<div class='container'>";
                    echo "<table border='1' style='width:100%'><tr><td>No.</td><td>Name</td><td>Price</td><td>Image</td><td>Description</td><td>Amount</td><td>Delete</td><td>Edit</td></tr>";
                    while($itemData = $db->fetchAssoc($query)){
                        echo "<tr><td>".$i."</td>";
                        // foreach ($itemData as $value) {
                        //     echo "<td>".$value."</td>";
                        //  }
                        echo"<td>".$itemData['item_name']."</td>";
                        echo"<td>".$itemData['item_price']."</td>";
                        echo"<td> <img src='".$itemData['item_img_url']."' class='img-responsive'> </td>";
                        echo"<td>".$itemData['item_description']."</td>";
                        echo"<td>".$itemData['item_amount']."</td>";
                        echo "<td><a href="."delete-product.php?id={$itemData['item_id']} onclick='return confirmDelete();'>Delete</a></td>";
                        echo "<td><a href="."edit-product.php?id={$itemData['item_id']}>Edit</a></td>";
                        echo "</tr>";
                        $i++;
                    }
                    echo "</table>";
                    echo"</div>";
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
        </div>
    </div>

</body>

</html>
