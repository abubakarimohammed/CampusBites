<?php
session_start();
include("db.php");

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE fullname='".$_SESSION['fullname']."'"));
$user_id = $user['id'];

$orders = mysqli_query($conn,"
SELECT orders.id, foods.food_name, foods.price, orders.quantity, orders.status, orders.ordered_at
FROM orders
JOIN foods ON orders.food_id = foods.id
WHERE orders.user_id = '$user_id'
ORDER BY orders.ordered_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">CampusBites</div>

    <div class="nav-buttons">
        <a href="student_dashboard.php" class="btn">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<div class="hero">
    <h1>My Orders</h1>
</div>

<table border="1" cellpadding="10" cellspacing="0" style="margin:30px auto; width:90%; border-collapse:collapse; background:white;">
<tr>
    <th>Food</th>
    <th>Price (GH₵)</th>
    <th>Quantity</th>
    <th>Status</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($orders)){ ?>

<tr>
    <td><?php echo $row['food_name']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['status']; ?></td>
    <td><?php echo $row['ordered_at']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>