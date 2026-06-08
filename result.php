<?php

// ===== PREVENT CACHING =====
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
// ===========================

if (isset($_POST['submit'])){
    include('dbcon.php');
    






    $class = $_POST['class'];
    $rollno = $_POST['rollno'];
    $sql = "SELECT * FROM `student_data` WHERE `class`='$class' AND `rollno`='$rollno'";
    $sql2 = "SELECT * FROM `user_mark` WHERE `class`='$class' AND `rollno`='$rollno'";
    $run = mysqli_query($con, $sql);
    $run2 = mysqli_query($con, $sql2);
    $row = mysqli_num_rows($run2);
    $data2 = mysqli_fetch_assoc($run2);

    if (mysqli_num_rows($run) > 0) {
        $data = mysqli_fetch_assoc($run);

        // -------- Verify password --------
        $password = $_POST['password'];
        $stored   = $data['password'];

        // Accept hashed passwords (password_verify) OR old plain-text ones.
        $passwordOk = password_verify($password, $stored) || hash_equals((string)$stored, (string)$password);

        if (!$passwordOk) {
            echo "<script>
                    alert('Wrong password. Please try again.');
                    window.location.href='index.php';
                  </script>";
            exit;
        }
        // ---------------------------------
        ?>

        <html>
        <head>
            <title>Result</title>
            <link rel="stylesheet" href="csss/result.css" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">

        </head>
        <script>
            // ===== HOME button: clear & replace history =====
            function goHome() {
                sessionStorage.clear();
                localStorage.clear();
                window.location.replace('index.php');
            }

            // ===== LOGOUT button: clear & replace history =====
            function logoutStudent() {
                sessionStorage.clear();
                localStorage.clear();
                window.location.replace('index.php');
            }

            // ===== When user navigates AWAY: clear everything =====
            window.addEventListener('pagehide', function() {
                sessionStorage.clear();
                document.querySelectorAll('input').forEach(i => {
                    if (i.type !== 'submit') i.value = '';
                });
            });

            // ===== CRITICAL: defeat browser bfcache =====
            // If browser tries to restore this page via back button,
            // immediately redirect to login so the data is never shown.
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    window.location.replace('index.php');
                }
            });
        </script>
        <body>
        <header>
            <nav>
                <div class="row clearfix">
                    <ul class="main-nav" animate slideInDown>
                        
                        <li><a href="#" onclick="goHome(); return false;"><b>HOME</b></a></li>
                        <li><a href="login.php"><b>ADMIN LOGIN</b></a></li>
                        <li><a href="#" onclick="logoutStudent(); return false;" style="color:#e74c3c;"><b> LOGOUT</b></a></li>
                    </ul>
                </div>
            </nav>
            <div class="main-content-header">
                <form align="center" method="post" action="result.php">
                
                    <tr>
                        <label>Name :</label>
                        <td><?php echo $data['name'] ?></td><br>
                    </tr>
                    
                    <tr>
                        <label>Class :</label>
                        <td><?php echo $data2['class']; ?></td><br>
                    </tr>
                    
                    <tr>
                        <label>Roll No :</label>
                        <td><?php echo $data['rollno']; ?></td>
                    </tr>
              
   
                    <table class="table1">
                        <tr>
                            <th>Subject</th>
                            <th>First Exam(A) </th>
                            <th>Second Exam(B)</th>
                            <th>Total</th>
                            <th>Grade point</th>
                            <th>Grade</th>
                        </tr>
                        <tr>
                            <td>Nepali</td>
                            <td><?php echo $data2['nepali1']; ?></td>
                            <td><?php echo $data2['nepali2']; ?></td>
                            <td><?php echo $total1 = $data2['nepali1'] + $data2['nepali2']; ?> </td>
                            <td><?php echo $grade1 = ($total1 / 200) * 4.0; ?></td>

                            <td><?php
                                // Nepal Grading System
                                $maxGrade1 = ($total1 / 200) * 4.0;
                                if ($maxGrade1 >= 3.6) {
                                    echo "A+";
                                } elseif ($maxGrade1 >= 3.2) {
                                    echo "A";
                                } elseif ($maxGrade1 >= 2.8) {
                                    echo "B+";
                                } elseif ($maxGrade1 >= 2.4) {
                                    echo "B";
                                } elseif ($maxGrade1 >= 2.0) {
                                    echo "C+";
                                } elseif ($maxGrade1 >= 1.6) {
                                    echo "C";
                                } else {
                                    echo "NG"; // Non Graded
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td><?php echo $data2['english1']; ?></td>
                            <td><?php echo $data2['english2']; ?></td>
                            <td><?php echo $total2 = $data2['english1'] + $data2['english2']; ?> </td>
                            <td><?php echo $grade2 = ($total2 / 200) * 4.0; ?></td>

                            <td><?php
                                // Nepal Grading System
                                $maxGrade2 = ($total2 / 200) * 4.0;
                                if ($maxGrade2 >= 3.6) {
                                    echo "A+";
                                } elseif ($maxGrade2 >= 3.2) {
                                    echo "A";
                                } elseif ($maxGrade2 >= 2.8) {
                                    echo "B+";
                                } elseif ($maxGrade2 >= 2.4) {
                                    echo "B";
                                } elseif ($maxGrade2 >= 2.0) {
                                    echo "C+";
                                } elseif ($maxGrade2 >= 1.6) {
                                    echo "C";
                                } else {
                                    echo "NG"; // Non Graded
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Math</td>
                            <td><?php echo $data2['math1']; ?></td>
                            <td><?php echo $data2['math2']; ?></td>
                            <td><?php echo $total3 = $data2['math1'] + $data2['math2']; ?> </td>
                            <td><?php echo $grade3 = ($total3 / 200) * 4.0; ?></td>

                            <td><?php
                                // Nepal Grading System
                                $maxGrade3 = ($total3 / 200) * 4.0;
                                if ($maxGrade3 >= 3.6) {
                                    echo "A+";
                                } elseif ($maxGrade3 >= 3.2) {
                                    echo "A";
                                } elseif ($maxGrade3 >= 2.8) {
                                    echo "B+";
                                } elseif ($maxGrade3 >= 2.4) {
                                    echo "B";
                                } elseif ($maxGrade3 >= 2.0) {
                                    echo "C+";
                                } elseif ($maxGrade3 >= 1.6) {
                                    echo "C";
                                } else {
                                    echo "NG"; // Non Graded
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Science</td>
                            <td><?php echo $data2['science1']; ?></td>
                            <td><?php echo $data2['science2']; ?></td>
                            <td><?php echo $total4 = $data2['science1'] + $data2['science2']; ?></td>
                            <td><?php echo $grade4 = ($total4 / 200) * 4.0; ?></td>

                            <td><?php
                                // Nepal Grading System
                                $maxGrade4 = ($total4 / 200) * 4.0;
                                if ($maxGrade4 >= 3.6) {
                                    echo "A+";
                                } elseif ($maxGrade4 >= 3.2) {
                                    echo "A";
                                } elseif ($maxGrade4 >= 2.8) {
                                    echo "B+";
                                } elseif ($maxGrade4 >= 2.4) {
                                    echo "B";
                                } elseif ($maxGrade4 >= 2.0) {
                                    echo "C+";
                                } elseif ($maxGrade4 >= 1.6) {
                                    echo "C";
                                } else {
                                    echo "NG"; // Non Graded
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Social</td>
                            <td><?php echo $data2['social1']; ?></td>
                            <td><?php echo $data2['social2']; ?></td>
                            <td><?php echo $total5 = $data2['social1'] + $data2['social2']; ?></td>
                            <td><?php echo $grade5 = ($total5 / 200) * 4.0; ?></td>

                            <td><?php
                                // Nepal Grading System
                                $maxGrade5 = ($total5 / 200) * 4.0;
                                if ($maxGrade5 >= 3.6) {
                                    echo "A+";
                                } elseif ($maxGrade5 >= 3.2) {
                                    echo "A";
                                } elseif ($maxGrade5 >= 2.8) {
                                    echo "B+";
                                } elseif ($maxGrade5 >= 2.4) {
                                    echo "B";
                                } elseif ($maxGrade5 >= 2.0) {
                                    echo "C+";
                                } elseif ($maxGrade5 >= 1.6) {
                                    echo "C";
                                } else {
                                    echo "NG"; // Non Graded
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>
                                <?php echo $data2['nepali1'] + $data2['english1'] + $data2['math1'] + $data2['science1'] + $data2['social1']; ?>
                            </td>
                            <td>
                                <?php echo $data2['nepali2'] + $data2['english2'] + $data2['math2'] + $data2['science2'] + $data2['social2']; ?>
                            </td>

                            <td><span><?php echo $all = $total1 + $total2 + $total3 + $total4 + $total5; ?></span></td>
                            <td><span><?php echo $all = ($grade1 + $grade2 + $grade3 + $grade4 + $grade5) / 5; ?></span></td>
                            <td><?php
                                // Calculate average grade
                                $averageGrade = ($grade1 + $grade2 + $grade3 + $grade4 + $grade5) / 5;

                                // Nepal Grading System
                                $gradingScale = array(
                                    "A+" => array("min" => 3.6, "max" => 4.0, "grade" => "A+"),
                                    "A" => array("min" => 3.2, "max" => 3.6, "grade" => "A"),
                                    "B+" => array("min" => 2.8, "max" => 3.2, "grade" => "B+"),
                                    "B" => array("min" => 2.4, "max" => 2.8, "grade" => "B"),
                                    "C+" => array("min" => 2.0, "max" => 2.4, "grade" => "C+"),
                                    "C" => array("min" => 1.6, "max" => 2.0, "grade" => "C"),
                                    "NG" => array("min" => 0.0, "max" => 1.6, "grade" => "NG")
                                );

                                // Find the appropriate grade based on the average grade
                                $maxGrade = "NG"; // Default to "Non Graded" if no other grade matches
                                foreach ($gradingScale as $grade => $range) {
                                    if ($averageGrade >= $range["min"] && $averageGrade < $range["max"]) {
                                        $maxGrade = $range["grade"];
                                        break; // Exit the loop once we find a matching grade
                                    }
                                }

                                echo $maxGrade;
                                ?></td>
                        </tr>
                    </table>


                    <marquee scrollamount="5"><p>Your Result is Declared. Kindly check your marks and in case of any discrepancy contact the admin. </p>
                    </marquee>
                </form>
            </div>
        </header>

        </body>
        </html>
        <?php
    } else {
        ?>
        <script>
            alert('Record Not found');
            window.open('index.php', '_self');
        </script>
        <?php
    }

}

?>
