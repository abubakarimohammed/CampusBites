<?php
session_start();
include("db.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $user['id'];

        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        if($user['role'] == "Student"){
            header("Location: student_dashboard.php");
        }elseif($user['role'] == "Vendor"){
            header("Location: vendor_dashboard.php");
        }else{
            header("Location: admin_dashboard.php");
        }

        exit();

    }else{
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - CampusBites</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">

<h2>Login</h2>

<form method="POST">

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<input type="submit" name="login" value="Login" class="submit-btn">

</form>

<p>Don't have an account?
<a href="register.php">Register</a>
</p>

</div>

</body>
</html>