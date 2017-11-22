<?php

include '../library/connection.php';
session_start();

if (isset($_POST['btn_search'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_guests WHERE guest_name = '".$_POST['search']."' OR serial_no = '".$_POST['search']."' OR contact_number = '".$_POST['search']."' ");

	if ($check->rowCount() > 0) 
	{
		$dis = $check->fetch(PDO::FETCH_ASSOC);

		$_SESSION['guest_name_am'] =  $dis['guest_name'];

		 $_SESSION['serial_number_am'] = $dis['serial_no'];

		$_SESSION['unit_am'] =  $dis['unit'];

		$_SESSION['contact_number_am'] =  $dis['contact_number'];

		$_SESSION['address_am'] =  $dis['address'];

		 $_SESSION['rank'] =  $dis['rank'];

		 $_SESSION['BOS_am'] =  $dis['BOS'];

		// $_SESSION['guest_type'] =  $dis['guest_type'];



		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Search Found!</span>
	                                </div>';
	 
			header("location:../request-mp.php");
	  
	}
	else
	{

		unset($_SESSION['guest_name_am']);

		unset($_SESSION['unit_am']);

		unset($_SESSION['contact_number_am']);

		unset($_SESSION['address_am']);

		unset($_SESSION['serial_number_am']);

		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> No Record Found!</span>
	                                    
	                                </div>';
	          header("location:../request-mp.php");
	}
}



?>
