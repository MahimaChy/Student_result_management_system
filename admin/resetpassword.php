<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// ===== Login guard (with exit) =====
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

include('../dbcon.php');

$message = "";

// ===== Handle a password reset submission =====
if (isset($_POST['reset'])) {
    $rollno  = mysqli_real_escape_string($con, $_POST['rollno']);
    $newpass = $_POST['newpass'];

    if (strlen($newpass) < 4) {
        $message = "<p style='color:#e74c3c;'>Password must be at least 4 characters.</p>";
    } else {
        $hashed = password_hash($newpass, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($con, "UPDATE student_data SET password=? WHERE rollno=?");
        mysqli_stmt_bind_param($stmt, "ss", $hashed, $rollno);

        if (mysqli_stmt_execute($stmt) && mysqli_stmt_affected_rows($stmt) > 0) {
            $message = "<p style='color:#27ae60;'>Password reset successfully for Roll No " . htmlspecialchars($rollno) . ".</p>";
        } else {
            $message = "<p style='color:#e74c3c;'>Could not reset password (student not found).</p>";
        }
        mysqli_stmt_close($stmt);
    }
}

// ===== Handle the search =====
$searchResults = null;
if (isset($_POST['search'])) {
    $class  = mysqli_real_escape_string($con, $_POST['class']);
    $rollno = mysqli_real_escape_string($con, $_POST['rollno_search']);
    $sql = "SELECT id, name, class, rollno FROM student_data
            WHERE class='$class' AND rollno='$rollno'";
    $searchResults = mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Student Password</title>
    <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f6f9; }
        nav { background:#2c3e50; padding:14px 20px; display:flex; justify-content:space-between; align-items:center; }
        nav a { color:#fff; text-decoration:none; margin-left:18px; font-weight:bold; }
        .box { width:420px; margin:30px auto; background:#fff; padding:25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,.1); }
        h2 { color:#2c3e50; text-align:center; }
        input[type=text], input[type=password] { width:100%; padding:9px; margin:6px 0 14px; box-sizing:border-box; border:1px solid #ccc; border-radius:4px; }
        button { background:#2c3e50; color:#fff; border:none; padding:10px 18px; border-radius:4px; cursor:pointer; }
        button:hover { background:#1a252f; }
        table { border-collapse:collapse; width:100%; margin-top:15px; }
        th, td { border:1px solid #ddd; padding:8px; text-align:center; font-size:14px; }
        th { background:#34495e; color:#fff; }
    </style>
</head>
<body>
    <nav>
        <a href="../index.php" class="logo">Results</a>
        <div>
            <a href="admindash.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="box">
        <h2>Reset Student Password</h2>
        <?php echo $message; ?>

        <!-- Step 1: search for the student -->
        <form method="post" action="resetpassword.php">
            <label>Class</label>
            <input type="text" name="class" required>
            <label>Roll No</label>
            <input type="text" name="rollno_search" required>
            <button type="submit" name="search">Search</button>
        </form>

<?php
if ($searchResults !== null) {
    if (mysqli_num_rows($searchResults) > 0) {
        echo "<table>
                <tr><th>Roll No</th><th>Name</th><th>Class</th><th>New Password</th></tr>";
        while ($s = mysqli_fetch_assoc($searchResults)) {
            // Step 2: each student gets an inline reset form
            echo "<tr>
                    <td>" . htmlspecialchars($s['rollno']) . "</td>
                    <td>" . htmlspecialchars($s['name']) . "</td>
                    <td>" . htmlspecialchars($s['class']) . "</td>
                    <td>
                      <form method='post' action='resetpassword.php' style='margin:0;'>
                        <input type='hidden' name='rollno' value='" . htmlspecialchars($s['rollno']) . "'>
                        <input type='password' name='newpass' placeholder='New password' required style='width:140px;margin:0 6px 0 0;display:inline-block;'>
                        <button type='submit' name='reset'>Reset</button>
                      </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:#e74c3c;'>No student found with that class and roll number.</p>";
    }
}
?>
    </div>
</body>
</html>
