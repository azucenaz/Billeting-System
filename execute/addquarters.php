<?php
include '../library/connection.php';
session_start();

if(isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_quarters WHERE quarters_name = '".$_POST['name']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] = ' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Quarters Already Exist!!!</span>
	                                </div>';
		header("location:../quarters.php");
	}
	else
	{	


		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);

	    $dbConn->query("INSERT INTO tbl_quarters (quarters_image,quarters_name,room_number,status) VALUES ('".$photo."','".$_POST['name']."','".$_POST['rooms']."','".$_POST['status']."')  ");
		
	    		$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> New Quarters Added!</span>
	                                </div>';


		header("location:../quarters.php");
	}
}

?>