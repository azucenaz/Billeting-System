<?php
include '../connection.php';
session_start();
if (isset($_POST['submit'])) 
{

	$check = $dbConn->query("SELECT * FROM tbl_ameneties where ameneties_name = '".$_POST['name']."' ");

	if ($check->rowCount() > 0) 
	{
		 $_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Exist!</strong>
									</div>';
												header("location:../ameneties.php");
	}
	else
	{
		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
     	 
     	 $dbConn->query("INSERT INTO tbl_ameneties (ameneties_name,ameneties_description,ameneties_image,ameneties_price,ameneties_status) VALUES ('".$_POST['name']."','".$_POST['description']."','".$photo."','".$_POST['price']."','available') ");
     	 $_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> New ameneties added.
									</div>';
									header("location:../ameneties.php");
	}

}

?>