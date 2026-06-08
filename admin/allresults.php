<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// ===== Login guard (with exit, so data never leaks) =====
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
    exit();
}

include('../dbcon.php');

// Helper: turn a GPA number into a Nepal grading letter
function gradeLetter($gpa) {
    if ($gpa >= 3.6) return "A+";
    if ($gpa >= 3.2) return "A";
    if ($gpa >= 2.8) return "B+";
    if ($gpa >= 2.4) return "B";
    if ($gpa >= 2.0) return "C+";
    if ($gpa >= 1.6) return "C";
    return "NG";
}

// Join students with their marks
$sql = "SELECT s.name, s.class, s.rollno, m.*
        FROM student_data s
        LEFT JOIN user_mark m ON s.rollno = m.rollno
        ORDER BY s.class, s.rollno";
$run = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Students Result</title>
    <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background:#f4f6f9; }
        nav { background:#2c3e50; padding:14px 20px; display:flex; justify-content:space-between; align-items:center; }
        nav a { color:#fff; text-decoration:none; margin-left:18px; font-weight:bold; }
        h2 { text-align:center; color:#2c3e50; margin:25px 0 15px; }
        table { border-collapse:collapse; width:95%; margin:0 auto 40px; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,.1); }
        th, td { border:1px solid #ddd; padding:10px 8px; text-align:center; font-size:14px; }
        th { background:#34495e; color:#fff; }
        tr:nth-child(even) td { background:#f9f9f9; }
        .grade { font-weight:bold; color:#27ae60; }
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

    <h2>All Students Result</h2>
    <table>
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Class</th>
            <th>Total (First)</th>
            <th>Total (Second)</th>
            <th>Grand Total</th>
            <th>GPA</th>
            <th>Grade</th>
        </tr>
<?php
if ($run && mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {

        // If a student has no marks row yet, show a dash
        if (!isset($row['nepali1'])) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['rollno']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['class']) . "</td>
                    <td colspan='5'>No marks added yet</td>
                  </tr>";
            continue;
        }

        // First-exam and second-exam totals
        $first  = $row['nepali1'] + $row['english1'] + $row['math1'] + $row['science1'] + $row['social1'];
        $second = $row['nepali2'] + $row['english2'] + $row['math2'] + $row['science2'] + $row['social2'];
        $grand  = $first + $second;

        // GPA = average of each subject's (total/200*4)
        $g1 = (($row['nepali1']  + $row['nepali2'])  / 200) * 4.0;
        $g2 = (($row['english1'] + $row['english2']) / 200) * 4.0;
        $g3 = (($row['math1']    + $row['math2'])    / 200) * 4.0;
        $g4 = (($row['science1'] + $row['science2']) / 200) * 4.0;
        $g5 = (($row['social1']  + $row['social2'])  / 200) * 4.0;
        $gpa = ($g1 + $g2 + $g3 + $g4 + $g5) / 5;

        echo "<tr>
                <td>" . htmlspecialchars($row['rollno']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['class']) . "</td>
                <td>$first</td>
                <td>$second</td>
                <td>$grand</td>
                <td>" . number_format($gpa, 2) . "</td>
                <td class='grade'>" . gradeLetter($gpa) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}
?>
    </table>
</body>
</html>
