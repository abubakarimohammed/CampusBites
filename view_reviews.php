<?php
session_start();
include "db.php";

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT reviews.*, users.fullname, foods.food_name
          FROM reviews
          JOIN users ON reviews.user_id = users.id
          JOIN foods ON reviews.food_id = foods.id
          ORDER BY reviews.created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Reviews</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="hero">
    <h1>Student Reviews</h1>
    <p>Reviews submitted by students</p>
</div>

<div class="table-container">

<table border="1" width="100%" cellspacing="0" cellpadding="10">

<tr>
    <th>Student</th>
    <th>Food</th>
    <th>Rating</th>
    <th>Review</th>
    <th>Date</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['food_name']; ?></td>
    <td><?php echo $row['rating']; ?> ⭐</td>
    <td><?php echo $row['review']; ?></td>
    <td><?php echo $row['created_at']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>