<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
				

if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

include('../dbcon.php');

if (isset($_POST['submit'])) {

    $class = $_POST['class'];
    $rollno = $_POST['rollno'];

    $nepali1 = $_POST['nepali1'];
    $english1 = $_POST['english1'];
    $math1 = $_POST['math1'];
    $science1 = $_POST['science1'];
    $social1 = $_POST['social1'];

    $nepali2 = $_POST['nepali2'];
    $english2 = $_POST['english2'];
    $math2 = $_POST['math2'];
    $science2 = $_POST['science2'];
    $social2 = $_POST['social2'];

    $sql = "INSERT INTO user_mark
            (rollno, class, nepali1, english1, math1, science1, social1,
             nepali2, english2, math2, science2, social2)
            VALUES
            ('$rollno', '$class', '$nepali1', '$english1', '$math1',
             '$science1', '$social1', '$nepali2', '$english2',
             '$math2', '$science2', '$social2')";

    $run = mysqli_query($con, $sql);

    if (!$run) {
        die("Database Error: " . mysqli_error($con));
    }

    echo "<script>
            alert('Data Inserted Successfully');
            window.location.href='admindash.php';
          </script>";
    exit();
}
?>