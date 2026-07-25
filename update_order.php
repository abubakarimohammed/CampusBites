<?php
session_start();
include "db.php";

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_orders.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM orders WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $status = $_POST['status'];

    $update = "UPDATE orders SET status='$status' WHERE id='$id'";
    mysqli_query($conn, $update);

    header("Location: view_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="hero">
    <div class="form-box">

        <h1>Update Order</h1>

        <form method="POST">

            <label>Status</label><br><br>

            <select name="status">
                <option <?php if($order['status']=="Pending") echo "selected"; ?>>Pending</option>
                <option <?php if($order['status']=="Preparing") echo "selected"; ?>>Preparing</option>
                <option <?php if($order['status']=="Ready") echo "selected"; ?>>Ready</option>
                <option <?php if($order['status']=="Delivered") echo "selected"; ?>>Delivered</option>
            </select>

            <br><br>

            <button type="submit" name="update" class="btn">Update Order</button>

        </form>

    </div>
</div>

</body>
</html>