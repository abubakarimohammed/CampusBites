<?php
session_start();
include "db.php";

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM foods WHERE id='$id'";

    mysqli_query($conn, $sql);
}

header("Location: manage_foods.php");
exit();
?>