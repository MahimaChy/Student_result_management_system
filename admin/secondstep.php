<?php
session_start();

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

include('../dbcon.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Prevent direct access
if (!isset($_POST['submit1'])) {
    header('location: addmark.php');
    exit();
}

// Collect and sanitize student details
$name   = mysqli_real_escape_string($con, $_POST['name']);
$class  = mysqli_real_escape_string($con, $_POST['class']);
$rollno = mysqli_real_escape_string($con, $_POST['rollno']);

// IMPORTANT: use lowercase table name
$password = $_POST['password'];
$hashed = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO student_data (name, class, rollno, password) VALUES ('$name','$class','$rollno','$hashed')";

$run = mysqli_query($con, $sql);

if (!$run) {
    die("Database Error: " . mysqli_error($con));
}

// Store in session
$_SESSION['student_name'] = $name;
$_SESSION['class'] = $class;
$_SESSION['rollno'] = $rollno;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Exam Marks</title>
    <link rel="stylesheet" href="../csss/secondstep.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">

    <style>
        label {
            display: inline-block;
            width: 120px;
            margin-bottom: 10px;
            text-align: left;
        }

        input[type="number"] {
            padding: 8px;
            width: 200px;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 25px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">

    <h3 class="m_text">Add Exam Marks</h3>
    <h4><?php echo htmlspecialchars($name); ?></h4>

    <p>
        Class: <?php echo htmlspecialchars($class); ?> |
        Roll No: <?php echo htmlspecialchars($rollno); ?>
    </p>

    <form method="post" action="thirdstep.php">

        <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <input type="hidden" name="class" value="<?php echo htmlspecialchars($class); ?>">
        <input type="hidden" name="rollno" value="<?php echo htmlspecialchars($rollno); ?>">

        <h4>First Exam (A)</h4>

        <label>Nepali:</label>
        <input type="number" name="nepali1" min="0" max="100" required><br>

        <label>English:</label>
        <input type="number" name="english1" min="0" max="100" required><br>

        <label>Math:</label>
        <input type="number" name="math1" min="0" max="100" required><br>

        <label>Science:</label>
        <input type="number" name="science1" min="0" max="100" required><br>

        <label>Social:</label>
        <input type="number" name="social1" min="0" max="100" required><br><br>

        <h4>Second Exam (B)</h4>

        <label>Nepali:</label>
        <input type="number" name="nepali2" min="0" max="100" required><br>

        <label>English:</label>
        <input type="number" name="english2" min="0" max="100" required><br>

        <label>Math:</label>
        <input type="number" name="math2" min="0" max="100" required><br>

        <label>Science:</label>
        <input type="number" name="science2" min="0" max="100" required><br>

        <label>Social:</label>
        <input type="number" name="social2" min="0" max="100" required><br><br>

        <input type="submit" name="submit" value="Submit" class="btn">

    </form>

</div>

</body>
</html>