<?php

include '../library/connection.php';
session_start();


if (isset($_POST['btn_search'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_guests WHERE serial_no = '".$_POST['txt_search']."' ");

	if ($check->rowCount() > 0) 
	{
		$dis = $check->fetch(PDO::FETCH_ASSOC);

		$_SESSION['guest_name'] =  $dis['guest_name'];

		$_SESSION['serial_number'] = $dis['serial_no'];

		$_SESSION['unit'] =  $dis['unit'];

		$_SESSION['contact_number'] =  $dis['contact_number'];

		$_SESSION['address'] =  $dis['address'];

		$_SESSION['rank'] =  $dis['rank'];

		$_SESSION['BOS'] =  $dis['BOS'];

		$_SESSION['guest_type'] =  $dis['guest_type'];

				$_SESSION['message'] = ' <div class="alert alert-success">
	                                    <span><b> Success - </b>Guest Account Found!</span>
	                              </div>';

			header("location:../request-mp.php#requestroom");
	  
	}
	else
	{

		// unset sessions

		unset($_SESSION['guest_name']);

		unset($_SESSION['serial_number']);

		unset($_SESSION['unit']);

		unset($_SESSION['rank']);

		unset($_SESSION['contact_number']);

		unset($_SESSION['address']);

		unset($_SESSION['guest_type']);

		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> No Record Found!</span>
	                                    
	                                </div>';
	          header("location:../request-mp.php#requestroom");
	}
}



?>
