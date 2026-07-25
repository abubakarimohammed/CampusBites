<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM foods ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Foods</title>
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
    <h1>Manage Foods</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Food Name</th>
            <th>Price (GH₵)</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['food_name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['image']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                 |<a href="edit_food.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete_food.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>