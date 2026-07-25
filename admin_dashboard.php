<?php
session_start();

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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

<h1>Welcome, <?php echo $_SESSION['fullname']; ?></h1>

<p>Administrator Dashboard</p>

<br><br>

<a href="add_food.php" class="btn">➕ Add Food</a>

&nbsp;&nbsp;

<a href="view_orders.php" class="btn">📦 View Orders</a>
&nbsp;&nbsp;
&nbsp;&nbsp;

<a href="reports.php" class="btn">📊 Reports</a>

&nbsp;&nbsp;

<a href="student_dashboard.php" class="btn">🍽️ View Student Menu</a>

</div>

</body>
</html>