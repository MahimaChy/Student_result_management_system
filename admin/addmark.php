<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
	

if (isset($_SESSION['uid'])) {
    echo "";
} else {
    header('location: ../login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // Function to check if a string contains only alphabetic characters and spaces
    function containsOnlyAlphabeticAndSpaces($str) {
        return preg_match('/^[A-Za-z\s]+$/', $str);
    }

    if (!containsOnlyAlphabeticAndSpaces($name)) {
        echo "Name should contain only alphabetic characters and spaces.";
        // You can provide a link to go back or handle this case as needed.
    } else {
        // Continue with the rest of your code
        // Redirect to secondstep.php or perform any other actions here
    }
}

?>

<html>
<head>
    <title>Add Marks</title>
    <link rel="stylesheet" href="../csss/addmark.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3 class=".m-text"> Enter the Details of Student</h3> <br>
        <form method="post" enctype="multipart/form-data" action="secondstep.php">
            <p class=".m-text">Full Name</p>
            <input type="text"
                name="name"
                placeholder="Enter Full Name"
                required
                class="box"
                pattern="[A-Za-z\s]+"
                title="Name should contain only alphabetic characters and spaces">
            <input type='number' name='class' placeholder='Class' min='1' max='9' required class="box"/>
            <p class=".m-text">Roll No</p>
            <input type='number' name='rollno' placeholder='Rollno' required class="box"/>

            <p class=".m-text">Set Password for Student 🔒</p>
            <input type='password' name='password' placeholder='At least 4 characters' required class="box" minlength="4"/>
            <br>
            <input type="submit" name="submit1" value="Next" class="btn"/>
        </form>
    </div>
</body>
</html>
