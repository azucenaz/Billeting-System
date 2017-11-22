<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	

	$dbConn->query("UPDATE tbl_reservations SET status = 'APPROVE',room_id = '".$_POST['facility_id']."',room_no = '".$_POST['room_no']."',total_payment ='".$_POST['payment']."' where reservation_id = '".$_POST['reservation_id']."'   ");


// status update
	$date = date("Y-m-d");

	$check = $dbConn->query("SELECT * FROM tbl_facilities");
	$dis = $check->fetch(PDO::FETCH_ASSOC);

	$cpcty = $dbConn->query("SELECT reservation_id FROM tbl_reservations WHERE room_id = '".$_POST['facility_id']."' AND datefrom = '".$date."' ");
	$count = $cpcty->rowCount();
	if ($count == $dis['facility_capacity'] ) {
		$dbConn->query("UPDATE tbl_facilities SET facility_status = 'UNAVAILABLE' where facility_id = '".$_POST['facility_id']."' "); 
	}else{

		$dbConn->query("UPDATE tbl_facilities SET facility_status = 'AVAILABLE' where facility_id = '".$_POST['facility_id']."' ");
	}




	$_SESSION['message'] = '<div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Reservation Has Been created.</span>
	                                    
	                                </div>';
	                                header("location:../approve.php");

}



?>