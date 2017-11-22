<?php
include '../library/connection.php';
session_start();

if(isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_barracks WHERE barracks_name = '".$_POST['name']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] = ' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Barracks Already Exist!!!</span>
	                                </div>';
		header("location:../barracks.php");
	}
	else
	{	


		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);

	    $dbConn->query("INSERT INTO tbl_barracks (barracks_image,barracks_name,bunks_number,status) VALUES ('".$photo."','".$_POST['name']."','".$_POST['rooms']."','".$_POST['status']."')  ");
		
	    		$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> New barracks Added!</span>
	                                </div>';


		header("location:../barracks.php");
	}
}

?>