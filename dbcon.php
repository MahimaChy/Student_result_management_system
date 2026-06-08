<?php
$con = mysqli_connect('localhost', 'root', '', 'srms');

if ($con == false) {
    die("Connection Error: " . mysqli_connect_error());
}
?>