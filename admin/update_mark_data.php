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
if(isset($_POST['submit']))
{
include('../dbcon.php');
    $rollno=$_POST['rollno'];
    $nepali1=$_POST['nepali1'];
    $english1=$_POST['english1'];
    $math1=$_POST['math1'];
    $science1=$_POST['science1'];
    $social1=$_POST['social1'];
    $nepali2=$_POST['nepali2'];
    $english2=$_POST['english2'];
    $math2=$_POST['math2'];
    $science2=$_POST['science2'];
    $social2=$_POST['social2'];
    
    $sql="UPDATE `user_mark` SET  `nepali1` = '$nepali1', `english1` = '$english1', `math1` = '$math1', `science1` = '$science1', `social1` = '$social1', `nepali2` = '$nepali2', `english2` = '$english2', `math2` = '$math2', `science2` = '$science2', `social2` = '$social2' WHERE `rollno` = '$rollno'";
    
    $run=mysqli_query($con,$sql);
    if($run)
    {
        ?>
        <script>
        alert('Data Updated  Succesfully');
        window.open('updatemark_form.php?sid=<?php echo $rollno; ?>', '_self');
             </script>
       
       
        <?php
    }
    else
    {
        echo "Error";
    }
}
?>