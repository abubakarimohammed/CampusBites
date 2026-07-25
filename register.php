<?php
include("db.php");

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users(fullname,email,password,role)
            VALUES('$fullname','$email','$password','$role')";

    if(mysqli_query($conn,$sql)){
        echo "<script>alert('Registration Successful');</script>";
    }else{
        echo "<script>alert('Registration Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - CampusBites</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="form-container">

<h2>Create Account</h2>

<form method="POST">

<input type="text" name="fullname" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<select name="role" required>
<option value="">Select Role</option>
<option value="Student">Student</option>
<option value="Vendor">Vendor</option>
</select>

<input type="submit" name="register" value="Register" class="submit-btn">

</form>

<p>Already have an account?
<a href="login.php">Login</a>
</p>

</div>

</body>
</html>