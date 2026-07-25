<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM foods WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Food</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="navbar">
    <div class="logo">CampusBites</div>

    <div class="nav-buttons">
        <a href="manage_foods.php" class="btn">Back</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<div class="form-container">

<h1>Edit Food</h1>

<form action="update_food.php" method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="food_name" value="<?php echo $row['food_name']; ?>" required>

<input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required>

<input type="text" name="image" value="<?php echo $row['image']; ?>" required>

<textarea name="description" required><?php echo $row['description']; ?></textarea>

<button type="submit">Update Food</button>

</form>

</div>

</body>
</html>