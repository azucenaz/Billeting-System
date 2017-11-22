<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_guests where guest_name = '".$_POST['guest_name']."'");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] = ' <div class="alert alert-danger">
	                                    <span><b> Error - </b> Guest Name already exist.</span>
	                                </div>';
		header("location:../guest.php");
	}
	else
	{
		
		$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b>New guest added.</span>
	                                </div>';
		$dbConn->query("INSERT INTO tbl_guests (guest_name,unit,contact_number,address,guest_type,reserve_of) VALUES ('".$_POST['guest_name']."','".$_POST['unit']."','".$_POST['contact']."','".$_POST['address']."','".$_POST['guest_type']."','".$_POST['reservation_type']."') ");
		header("location:../guest.php");
		
	}
}

// }else if (isset($_POST['submit-guest-mp'])) 

// {
// 	$check = $dbConn->query("SELECT * FROM tbl_guests where guest_name = '".$_POST['guest_name']."'");
// 	if ($check->rowCount() > 0) 
// 	{
// 		$_SESSION['message'] = ' <div class="alert alert-danger">
// 	                                    <span><b> Success - </b>New guest added.</span>
// 	                                </div>';
// 		header("location:../request-mp.php");
// 	}
// 	else
// 	{
		
// 		$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
// 	                                    <span><b> Success - </b>Guest Info Saved! Request Your Reservation.</span>
// 	                                </div>';
// 		$dbConn->query("INSERT INTO tbl_guests (guest_name,unit,contact_number,address,guest_type,status) VALUES ('".$_POST['guest_name']."','".$_POST['unit']."','".$_POST['contact']."','".$_POST['address']."','".$_POST['guest_type']."','".$_POST['stat']."') ");
// 		header("location:../request-mp.php");
		
// 	}

// } 




?>