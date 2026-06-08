<?php
// Block browser from caching this login page
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html>
<head>
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="csss/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
</head>
<body>
    <nav>
        <a href="index.php" class="logo">Results</a>
        <a href="login.php" class="btn">login</a>
    </nav>

    <section class="sec">
        <form method="post" action="result.php" autocomplete="off">
            <h2>🎓 Student Login</h2>
            <p class="subtitle">Enter your details to view your result</p>
            <input type="text" name="class" required placeholder="Enter your Class" autocomplete="off"/>
            <input type="text" name="rollno" required placeholder="Enter your Roll Number" autocomplete="off"/>
            <input type="password" name="password" required placeholder="Enter your Password" autocomplete="new-password"/>
            <input type="submit" name="submit" value="SHOW RESULT" class="sub"/>
        </form>
    </section>

    <script>
        // Clear form when page loads (handles browser back-button restore)
        window.addEventListener('pageshow', function() {
            document.querySelectorAll('input').forEach(i => {
                if (i.type !== 'submit') i.value = '';
            });
        });
    </script>
</body>
</html>
