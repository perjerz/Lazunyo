<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] < 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'form-login.php';</script>";
}
include_once("/includes/config.php");
include_once("/includes/class_mysql.php");
#-> Get data from js and initialize
#$data = file_get_contents("php://input");
#$json = json_decode($data);
#-> Connect to the database
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
$id = $_GET['id'];
#-> Query the data.
$query = $db->querydb("SELECT item_name,item_price,item_img_url,item_description,item_amount FROM ".TB_ITEM." WHERE item_id =".$id.";");
#-> Preparing return data.
if($query)
{
    $itemData = $db->fetchAssoc($query);
}
else
{
    $db->closedb();
    echo "<script type='text/javascript'>alert('Error occured. Cannot Edit the item.');window.location.href = 'show-product.php';</script>";
}
$db->closedb();
?>
<script type="text/javascript">
function logout()
{
 window.location.assign("logout.php");
}
</script>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Lazunyo | Seller Inventory </title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

</head>


    <header>
        <h1>Lazunyo - Inventory Management </h1>
        <h2 onclick="logout()">Logout</h2>
    </header>

    <ul>
        <li><a href="show-product.php">Product's Info</a></li>
        <li><a href="add-product.php"><!--class="active"-->Add</a></li>
        <li><a href="#" class="active">Edit</a></li>
    </ul>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->
        <form class="form-basic" method="post" action="edit-product-query.php">

            <div class="form-title-row">
                <h1>Edit product</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Product's Name</span>
                    <input type="text" name="name" placeholder="Fill Product's Name" required value="<?php echo $itemData['item_name'];?>">
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Price</span>
                    <input type="number" step="0.01" name="price" placeholder="Fill Product's Price" required value="<?php echo $itemData['item_price'];?>">
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Image</span>
                    <input type="text" name="image" placeholder="Fill Image's link" required value="<?php echo $itemData['item_img_url'];?>">
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Description</span>
                    <textarea type="text" name="description" placeholder="Fill Description" required><?php echo $itemData['item_description'];?></textarea>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Quantity</span>
                    <input type="number" name="qty" min="0" placeholder="Fill Image's link" required value="<?php echo $itemData['item_amount'];?>">
                </label>
            </div>
            <input type="hidden" value="<?php echo $id?>" name="id"/>
            <div class="form-row">
                <button type="submit">Confirm</button>
            </div>

        </form>

    </div>

</body>

</html>
