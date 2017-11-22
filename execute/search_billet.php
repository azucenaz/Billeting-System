<?php

include '../library/connection.php';
session_start();



if (isset($_POST['btn_search'])) 
{

	$_SESSION['requesttype'] = 'billeting';
	$check = $dbConn->query("SELECT * FROM tbl_guests WHERE serial_no = '".$_POST['search']."' ");

	if ($check->rowCount() > 0) 
	{
		$dis = $check->fetch(PDO::FETCH_ASSOC);

		$_SESSION['guest_name_billet'] =  $dis['guest_name'];

		$_SESSION['serial_number_billet'] = $dis['serial_no'];

		$_SESSION['unit_billet'] =  $dis['unit'];

		$_SESSION['contact_number_billet'] =  $dis['contact_number'];

		$_SESSION['address_billet'] =  $dis['address'];

		$_SESSION['rank'] =  $dis['rank'];

		$_SESSION['BOS'] =  $dis['BOS'];

		$_SESSION['guest_type'] =  $dis['guest_type'];



		$_SESSION['message1'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Search Found!</span>
	                                </div>';
	 
			header("location:../request-mp.php");
	  
	}
	else
	{

		unset($_SESSION['guest_name_billet']);

		unset($_SESSION['serial_number_billet']);

		unset($_SESSION['unit_billet']);

		unset($_SESSION['contact_number_billet']);

		unset($_SESSION['address_billet']);

		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> No Record Found!</span>
	                                    
	                                </div>';
	          header("location:../request-mp.php");
	}
}



?>
