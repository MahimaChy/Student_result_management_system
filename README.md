**Student Result Management System**
A web-based system to manage student marks and academic records. Built with PHP, MySQL, HTML, CSS, and JavaScript.

The system has a secure admin login, an interactive dashboard, and full CRUD support for adding, updating, and deleting student data and marks. Students can look up their results by entering their class and roll number, and the system automatically calculates totals, GPA, and letter grades based on the Nepal grading system.

How to run
1.Install XAMPP, WAMP, or MAMP (any local PHP + MySQL server).
2.Copy this folder into the server's web root:
XAMPP / MAMP: htdocs/student-result-management-system
3.Start Apache and MySQL from the control panel.
4.Open phpMyAdmin, create a database called srms, and import database/sql.sql.
5.If your MySQL has a different username or password, update them in dbcon.php (default is host localhost, user root, no password).
6.Open in browser:
Home: http://localhost/student-result-management-system/index.php
Admin login: http://localhost/student-result-management-system/login.php


