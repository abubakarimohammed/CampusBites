<?php
session_start();
include "db.php";

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

/* Update order status */
if (isset($_POST['update'])) {

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id='$order_id'";
    mysqli_query($conn, $sql);

    header("Location: vendor_dashboard.php");
    exit();
}

/* Display all orders */
$sql = "SELECT
            orders.id,
            users.fullname,
            foods.food_name,
            orders.quantity,
            orders.status,
            orders.ordered_at
        FROM orders
        JOIN users ON orders.user_id = users.id
        JOIN foods ON orders.food_id = foods.id
        ORDER BY orders.ordered_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="navbar">
    <div class="logo">CampusBites</div>

    <div class="nav-buttons">
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<div class="hero">

<h1>Vendor Dashboard</h1>

<table border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>Student</th>
    <th>Food</th>
    <th>Quantity</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['fullname']; ?></td>

<td><?php echo $row['food_name']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>

<form method="POST">

<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

<select name="status">

<option value="Pending"
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Preparing"
<?php if($row['status']=="Preparing") echo "selected"; ?>>
Preparing
</option>

<option value="Ready"
<?php if($row['status']=="Ready") echo "selected"; ?>>
Ready
</option>

<option value="Completed"
<?php if($row['status']=="Completed") echo "selected"; ?>>
Completed
</option>

</select>

</td>

<td><?php echo $row['ordered_at']; ?></td>

<td>

<input type="submit" name="update" value="Update">

</td>

</form>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>