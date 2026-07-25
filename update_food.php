<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $sql = "UPDATE foods SET
            food_name='$food_name',
            price='$price',
            image='$image',
            description='$description'
            WHERE id='$id'";

    mysqli_query($conn, $sql);
}

header("Location: manage_foods.php");
exit();
?>