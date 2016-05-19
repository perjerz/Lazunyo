<?php
session_start();
if(!isset($_SESSION['id']) || $_SESSION['id'] < 0)
{
    echo "<script type='text/javascript'>alert('You have not logged in yet.');window.location.href = 'index.html';</script>";
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

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

</head>


    <header>
        <h1>Lazunyo - Inventory Management </h1>
        <h2 onclick="logout()">Logout</h2>
    </header>

    <ul>
        <li><a href="show-product.php">Product's Info</a></li>
        <li><a href="#" class="active">Add</a></li>
        </ul>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->
        <form class="form-basic" method="post" action="add-product-query.php">

            <div class="form-title-row">
                <h1>Add New product</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Product's Name</span>
                    <input type="text" name="name" placeholder="Fill Product's Name" required>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Price</span>
                    <input type="number" step="0.01" name="price" placeholder="Fill Product's Price" required>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Image</span>
                    <input type="text" name="image" placeholder="Fill Image's link" required>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Description</span>
                    <textarea type="text" name="description" placeholder="Fill Description" required></textarea>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span>Product's Quantity</span>
                    <input type="number" name="qty" min="0" placeholder="Fill Image's link" required pattern="https?://.+">
                </label>
            </div>
            <div class="form-row">
                <button type="submit">Confirm</button>
            </div>

        </form>

    </div>

</body>

</html>
