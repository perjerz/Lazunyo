<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['id'] < 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'index.html';</script>";
}
error_reporting(E_ALL ^ E_DEPRECATED);
#-> Connect to the database
include_once(dirname(dirname(__FILE__)).'/public/includes/config.php');
include_once(dirname(dirname(__FILE__)).'/public/includes/class_mysql.php');
$db = new Database();
$db->connectdb(DB_NAME,DB_USER,DB_PASS);
#-> Get data from js and initialize
#$data = file_get_contents("php://input");
#$json = json_decode($data);
#-> Connect to the database
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
    echo "<script type='text/javascript'>alert('Error occured. Cannot Edit the item.');window.location.href = 'show-product.php';</script>";
}
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

    <link rel="stylesheet" href="assets/form-basic.css">
    <link rel="stylesheet" href="assets/main.css">

</head>


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
                                echo $user['fullName'];
                                ?>
                                <?php $db->closedb();?>
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
            <div class="tab-section">
                <ul class="menu-list">
                    <p class="topic">user menu</p>
                    <a href="logout.php" class="menu-item"><i class="fa fa-list-alt"></i> Logout</a>
                </ul>
            </div>
        </div>
    </div>


    <div class="content">

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
                    <input type="number" name="qty" min="0" placeholder="Fill quantity in stock " required value="<?php echo $itemData['item_amount'];?>">
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
