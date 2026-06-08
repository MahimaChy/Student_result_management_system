<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


$timeout_duration = 120;
if (isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > $timeout_duration) {
    $_SESSION = array();
    session_destroy();
    header('Location: ../login.php');
    exit();
}
$_SESSION['last_activity'] = time();
				

if(isset($_SESSION['uid']))
	{
		echo "";
		}
		else
		{
			header('location: ../login.php');
			}


?> 
<html>
<head>
    <title>Admin Dashboard</title>
<link rel="stylesheet" href="../csss/admindash.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">

</head>
<body>
      <nav>
      <a href="../index.php" class="logo">Results</a>

        <ul class="nav-list">
        <li><a href="addmark.php">Add Marks </a></li>
        <li><a href="updatemark.php">Update </a><li>
        <li><a href="deleteform.php">Delete </a></li>
        <li><a href="allresults.php">All Results </a></li>
        <li><a href="resetpassword.php">Reset Password </a></li>

        </ul>

        <a href="logout.php" class="btn">logout</a>
        
      </nav>

      <section class="sec">
      <form method="post" action="updatemark.php">
      <table>
  <caption>Student Record</caption>
  <thead>
    <tr>
           <th class="id_h1">Id </th>
           <th class="name_h1">Name </th> 
           <th class="contact_h1">Class </th> 
           <th class="contact_h1">Roll No</th>
    </tr>
  </thead>
  <tbody>
    <tr>
            
<?php
include('../dbcon.php');
  $sql="SELECT * FROM `student_data`";
  $run=mysqli_query($con,$sql);
  if(mysqli_num_rows($run)>0)
{
     while($row=mysqli_fetch_assoc($run))
     {
           
        ?>
        <tr>
            <th class="id_h"> <?php  echo $row['id'].'<br>'; ?></th>
            <th class="name_h"> <?php  echo $row['name'].'<br>'; ?></th> 
            <th class="email_h"> <?php  echo $row['class'].'<br>'; ?></th> 
            <th class="contact_h"> <?php  echo $row['rollno'].'<br>'; ?></th> 
        </tr>     
        <?php 
           
        }
}
else{
    echo "No Record Found";
}
?>
    </tr>
  </body>
</table>      
      </section>
</body>
</html>