<?php
session_start();
include "db.php";

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['add_food'])){

    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO foods(food_name, price, image, description)
            VALUES('$food_name','$price','$image','$description')";

    mysqli_query($conn, $sql);

    echo "<script>alert('Food Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Food - CampusBites</title>
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

<div class="form-container">

<h2>Add New Food</h2>

<form method="POST">

<input type="text" name="food_name" placeholder="Food Name" required>

<input type="number" step="0.01" name="price" placeholder="Price" required>

<input type="text" name="image" placeholder="Image Name (example: jollof.jpg)" required>

<textarea name="description" placeholder="Food Description" required></textarea>

<br><br>

<input type="submit" name="add_food" value="Add Food" class="btn">

</form>

</div>

</body>
</html>