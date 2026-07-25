<?php
session_start();
include("db.php");
$total_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$total_foods = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM foods"));
$total_orders = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
$total_reviews = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM reviews"));

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="hero">
    <h1>CampusBites Reports</h1>
    <p>System Summary</p>
</div>
<div style="width:70%; margin:40px auto;">

<table border="1" cellpadding="15" cellspacing="0" style="width:100%; border-collapse:collapse; background:white; text-align:center;">

<tr>
    <th>Total Users</th>
    <th>Total Foods</th>
    <th>Total Orders</th>
    <th>Total Reviews</th>
</tr>

<tr>
    <td><?php echo $total_users; ?></td>
    <td><?php echo $total_foods; ?></td>
    <td><?php echo $total_orders; ?></td>
    <td><?php echo $total_reviews; ?></td>
</tr>

</table>

</div>
<div style="text-align:center; margin-top:30px;">
    <a href="admin_dashboard.php" class="btn">← Back to Dashboard</a>
</div>



</body>
</html>