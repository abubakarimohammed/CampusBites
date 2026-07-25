<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT orders.*, users.fullname, foods.food_name, foods.price
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN foods ON orders.food_id = foods.id
        ORDER BY orders.ordered_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">CampusBites</div>

    <div class="nav-buttons">
        <a href="admin_dashboard.php" class="btn">Dashboard</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<div class="hero">
    <h1>All Orders</h1>

    <table border="1" cellpadding="8">
        <tr>
            <th>Student</th>
            <th>Food</th>
            <th>Price (GH₵)</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['food_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
    <a href="update_order.php?id=<?php echo $row['id']; ?>" class="btn">
        Update
    </a>
</td>
            <td><?php echo $row['ordered_at']; ?></td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>