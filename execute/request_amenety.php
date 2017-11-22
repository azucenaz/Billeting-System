<?php

include '../connection.php';
session_start();

if (isset($_POST['submit'])) 
{

	$check = $dbConn->query("SELECT * FROM tbl_guests where serial_no = '".$_POST['serial_number']."' OR contact_number = '".$_POST['contact_number']."' OR guest_name = '".$_POST['guest_name']."' ");
	if ($check->rowCount() > 0) 
	{


		$dbConn->query("UPDATE tbl_guests SET guest_name = '".$_POST['guest_name']."',rank = '".$_POST['rank']."',
		BOS = '".$_POST['BOS']."',unit = '".$_POST['unit']."',contact_number = '".$_POST['contact_number']."',address = '".$_POST['address']."',
		guest_type = '".$_POST['guest_type']."',status = '".$_POST['stat']."' where serial_no = '".$_POST['serial_number']."' AND guest_name = '".$_POST['guest_name']."' ");
		
		$display = $check->fetch(PDO::FETCH_ASSOC);
			
		$dbConn->query("INSERT INTO tbl_reservations (datefrom,dateto,unique_id,status,type,user_id,date_of_reservation) VALUES ('".$_POST['from']."','".$_POST['to']."','".$display['unique_id']."','PENDING','Room Accomodation','".$_SESSION['user_id']."','".date("Y-m-d h:i:sa")."') ");


		$_SESSION['message'] = ' <div class="alert alert-info">
	                                    <span><b> Information - </b>Guest Account updated Request Sent!</span>
	                              </div>';

	    // unset sessions

		unset($_SESSION['guest_name_am']);

		unset($_SESSION['serial_number_am']);

		unset($_SESSION['unit_am']);

		unset($_SESSION['rank']);

		unset($_SESSION['BOS']);

		unset($_SESSION['contact_number_am']);

		unset($_SESSION['address_am']);
                        



	     header("location:../request-mp.php");



	}else{

	$id = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);


	$guest = $dbConn->query("INSERT INTO tbl_guests (guest_name,rank,serial_no,BOS,unit,contact_number,address,guest_type,status,unique_id) 
		VALUES ('".$_POST['guest_name']."','".$_POST['rank']."','".$_POST['serial_number']."','".$_POST['BOS']."','".$_POST['unit']."','".$_POST['contact_number']."','".$_POST['address']."','".$_POST['guest_type']."','PENDING','".$id."') ");

	$get = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$id."' ");
	$display = $get->fetch(PDO::FETCH_ASSOC);
	
	$room = $dbConn->query("SELECT * FROM tbl_ameneties where ameneties_id = '".$_POST['reserve_of']."' ");
	$row = $room->fetch(PDO::FETCH_ASSOC);


	$dbConn->query("INSERT INTO tbl_reservations (total_payment,room_id,datefrom,dateto,unique_id,status,type,user_id,date_of_reservation) VALUES ('".$row['ameneties_price']."','".$row['ameneties_id']."','".$_POST['from']."','".$_POST['to']."'
		,'".$display['unique_id']."','PENDING','Ameneties','".$_SESSION['user_id']."','".date("Y-m-d h:i:sa")."') ");

	$_SESSION['message'] = ' <div class="alert alert-success">
	                                    <span><b> Success - </b>Guest request Sent!</span>
	                                </div>';

// unset sessions

		unset($_SESSION['guest_name_am']);

		unset($_SESSION['serial_number_am']);

		unset($_SESSION['unit_am']);

		unset($_SESSION['rank']);

		unset($_SESSION['BOS']);

		unset($_SESSION['contact_number_am']);

		unset($_SESSION['address_am']);


		header("location:../request-mp.php");
	}



}
?>
