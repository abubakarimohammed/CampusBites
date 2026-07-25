<?php
session_start();
include("db.php");

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE fullname='".$_SESSION['fullname']."'"));
$user_id = $user['id'];

if(isset($_GET['order'])){
    $food_id = $_GET['order'];

    mysqli_query($conn, "INSERT INTO orders(user_id, food_id) VALUES('$user_id','$food_id')");

    echo "<script>alert('Order placed successfully!');</script>";
}

$foods = mysqli_query($conn, "SELECT * FROM foods");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="logo">CampusBites</div>

    <div class="nav-buttons">
        <a href="order_history.php" class="btn">My Orders</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<div class="hero">
    <h1>Welcome, <?php echo $_SESSION['fullname']; ?></h1>
    <p>Available Meals</p>
</div>

<div class="food-container">

<?php while($food = mysqli_fetch_assoc($foods)){ ?>
<?php
$rating_query = mysqli_query($conn,
"SELECT AVG(rating) AS average_rating,
COUNT(id) AS total_reviews
FROM reviews
WHERE food_id = ".$food['id']);

$rating = mysqli_fetch_assoc($rating_query);
?>

<div class="food-card">

<h3><?php echo $food['food_name']; ?></h3>

<p><?php echo $food['description']; ?></p>

<h4>GH₵ <?php echo $food['price']; ?></h4>
<p>
<?php
if($rating['average_rating'] != NULL){

    $stars = round($rating['average_rating']);

    for($i = 1; $i <= $stars; $i++){
        echo "⭐";
    }

    echo " ".number_format($rating['average_rating'],1)." (".$rating['total_reviews']." reviews)";

}else{
    echo "No ratings yet";
}
?>
</p>


<a href="student_dashboard.php?order=<?php echo $food['id']; ?>" class="btn">Order Now</a>
<br><br>

<a href="review_food.php?food_id=<?php echo $food['id']; ?>" class="btn">
    Review Food
</a>

</div>

<?php } ?>

</div>

</body>
</html>