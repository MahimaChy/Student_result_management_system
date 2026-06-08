<?php
session_start();
// 1. Move logic to the top to allow the 'header' redirect to work
if(isset($_SESSION['uid'])) {
    header('location:admin/admindash.php');
    exit();
}

if(isset($_POST['submit'])) {
    include('dbcon.php');
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $qry = "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password'";
    $run = mysqli_query($con, $qry);
    $row = mysqli_num_rows($run);

    if($row < 1) {
        echo "<script>alert('Username or Password Not Match'); window.open('login.php','_self');</script>";
    } else {
        $data = mysqli_fetch_assoc($run);
        $_SESSION['uid'] = $data['id'];
        header('location:admin/admindash.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login here</title>
    <link rel="stylesheet" href="csss/login.css" type="text/css">
    <style>
        body { background-image: url("./teacher.jpg"); background-size: cover; height: 100vh; margin: 0; }
    </style>
</head>
<body>
    <nav>
        <a href="index.php" class="logo">Results</a>
        <a href="login.php" class="btn">login</a>
    </nav>
    <section class="sec">
        <form method="post" action="login.php">
            <h1>Login</h1>
            <input type="text" name="username" required placeholder="Enter your username"/>
            <input type="password" name="password" required placeholder="Enter your password"/><br>
            <input type="submit" name="submit" value="SUBMIT" class="sub"/>
        </form>
    </section>         
</body>
</html>