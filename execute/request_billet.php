	<?php

include '../connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_guests where serial_no = '".$_POST['serial_number']."' ");
	if ($check->rowCount() > 0) 
	{

		$dbConn->query("UPDATE tbl_guests SET guest_name = '".$_POST['g_name']."',rank = '".$_POST['rank']."',serial_no = '".$_POST['serial_number']."',
		BOS = '".$_POST['BOS']."',unit = '".$_POST['unit']."',contact_number = '".$_POST['contact_number']."',address = '".$_POST['address']."',
		guest_type = '".$_POST['guest_type']."',status = '".$_POST['stat']."' where serial_no = '".$_POST['serial_number']."' ");

		$display = $check->fetch(PDO::FETCH_ASSOC);
		
		$dbConn->query("INSERT INTO tbl_assign (unique_id,user_id,date_of_reservation,status) VALUES ('".$display['unique_id']."','".$_SESSION['user_id']."','".date("Y-m-d h:i:sa")."','PENDING') ");


		$_SESSION['message'] = ' <div class="alert alert-info">
	                                    <span><b> Information - </b>Guest Account updated Request Sent!</span>
	                              </div>';

	    // unset sessions

		unset($_SESSION['guest_name_billet']);

		unset($_SESSION['serial_number_billet']);

		unset($_SESSION['unit']);

		unset($_SESSION['rank']);

		unset($_SESSION['contact_number_billet']);

		unset($_SESSION['address_billet']);



	     header("location:../request-mp.php");

	} else {

	$id = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);


	$guest = $dbConn->query("INSERT INTO tbl_guests (guest_name,rank,serial_no,BOS,unit,contact_number,address,guest_type,status,unique_id) VALUES ('".$_POST['g_name']."','".$_POST['rank']."','".$_POST['serial_number']."','".$_POST['BOS']."','".$_POST['unit']."','".$_POST['contact_number']."','".$_POST['address']."','".$_POST['guest_type']."','PENDING','".$id."') ");

	$get = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$id."' ");
	$display = $get->fetch(PDO::FETCH_ASSOC);

	$dbConn->query("INSERT INTO tbl_assign (unique_id,user_id,date_of_reservation,status) VALUES ('".$display['unique_id']."','".$_SESSION['user_id']."','".date("Y-m-d h:i:sa")."','PENDING') ");

	$_SESSION['message'] = ' <div class="alert alert-success">
	                                    <span><b> Success - </b>Guest Registered, Request Sent!.</span>
	                                </div>';
// unset sessions

		unset($_SESSION['guest_name_billet']);

		unset($_SESSION['serial_number_billet']);

		unset($_SESSION['unit']);

		unset($_SESSION['rank']);

		unset($_SESSION['contact_number_billet']);

		unset($_SESSION['address_billet']);

		header("location:../request-mp.php");

	}


	
}

?>