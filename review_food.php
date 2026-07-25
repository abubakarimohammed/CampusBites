<?php
session_start();
include "db.php";

if (!isset($_SESSION['fullname'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['food_id'])) {
    die("Food not selected.");
}

$food_id = $_GET['food_id'];

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $sql = "INSERT INTO reviews (user_id, food_id, rating, review)
            VALUES ('$user_id', '$food_id', '$rating', '$review')";

    mysqli_query($conn, $sql);

    header("Location: student_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Review Food</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="hero">
    <div class="form-box">

        <h1>Rate This Food</h1>

        <form method="POST">

            <label>Rating</label><br><br>

            <select name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>

            <br><br>

            <label>Review</label><br><br>

            <textarea name="review" rows="5" cols="40" required></textarea>

            <br><br>

            <button type="submit" name="submit" class="btn">
                Submit Review
            </button>

        </form>

    </div>
</div>

</body>
</html>