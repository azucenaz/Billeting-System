<?php
include '../library/connection.php';
session_start();

if(isset($_POST['submit'])) 
	{
	// $check = $dbConn->query("SELECT * FROM tbl_guests where guest_name = '".$_POST['guest_name']."' AND guest_id = '".$_POST['guest_id']."'");
	// if ($check->rowCount() > 0) 
	// {
	// 	$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	//                                     <span><b> Error - </b> Guest name already exist.</span>
	//                                 </div>';
	// 	header("location:../guest.php");
	// }
	// else

		$dbConn->query("UPDATE tbl_guests SET guest_name = '".$_POST['guest_name']."',unit = '".$_POST['unit']."',contact_number = '".$_POST['contact']."',address = '".$_POST['address']."',guest_type = '".$_POST['guest_type']."',status = '".$_POST['status']."' where guest_id = '".$_POST['guest_id']."' ");                            

		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Guest ID: '.$_POST['guest_id'].' - </b> Guest Information has been updated</span>
	                                </div>';
		header("location:../guest.php");

	}
else if (isset($_POST['submit-guest-mp'])) 

{

	$dbConn->query("UPDATE tbl_guests SET guest_name = '".$_POST['guest_name']."',unit = '".$_POST['unit']."',contact_number = '".$_POST['contact']."',address = '".$_POST['address']."',guest_type = '".$_POST['guest_type']."' where guest_id = '".$_POST['guest_id']."' ");                            

		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Guest ID: '.$_POST['guest_id'].' - </b> Guest Information has been updated</span>
	                                </div>';
		header("location:../guest-mp.php");




}
?>