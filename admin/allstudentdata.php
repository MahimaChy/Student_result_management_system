<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
				

				if(isset($_SESSION['uid']))
				{
					echo "";
				}
				else
				{
					header('location: ../login.php');
          exit();
				}

        
?>
<html>
<head>
    <title>All Student Detail</title>
<link rel="stylesheet" href="../csss/allstudentdata.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Flamenco" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

</head>
<body>
    <header>
      <nav>
        <div class="row clearfix">
            <ul class="main-nav" animate slideInDown>
                <li><a href="../index.php"><b>HOME</b></a></li>
                <li class="logout"><a href="admindash.php"><b>ADMIN DASHBOARD</b></a></li>
                
          </ul>
        </div>
      </nav>
      <div class="main-content-header">
        <h2>Student Record</h2>
        <form>
         <table>
          <tr>
           <th class="id_h1">Id </th>
           <th class="name_h1">Name </th> 
           <th class="contact_h1">Class </th> 
           <th class="contact_h1">Roll No</th>
         </tr>
        
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
              </table>
        </form>
      </div>
    </header>
</body>
</html>