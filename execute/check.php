<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_reservations where datefrom <= '".$_POST['from']."' AND dateto >= '".$_POST['from']."' and room_id = '".$_POST['room_id']."' and room_no = '".$_POST['room_no']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Room number reservation already exist.</span>
	                                </div>';
	 
			header("location:../process_reservation_Facilities.php");
	  
	}
	else
	{
		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Available - </b> This facility is available that time.</span>
	                                    
	                                </div>';

	     // Get room price

	    $getprice = $dbConn->query("SELECT * FROM tbl_facilities where facility_id = '".$_POST['room_id']."' ");
	    $disprice = $getprice->fetch(PDO::FETCH_ASSOC);

	    // compute price
	    $start = strtotime($_POST['from']);
$end = strtotime($_POST['to']);

$timediff = abs($end - $start);

$days  = $timediff / 86400;

$numbers = intval($days) + 1;

	$_SESSION['true'] = 'true';

$_SESSION['payment'] = $numbers * $disprice['facility_price'];

	    $_SESSION['room_id'] = $_POST['room_id'];
	    $_SESSION['room_name'] = $disprice['facility_name'];
	    $_SESSION['room_no'] = $_POST['room_no'];
	    $_SESSION['from'] = $_POST['from'];
	    $_SESSION['to'] = $_POST['to'];
	    
			header("location:../process_reservation_Facilities.php");
	  
	}
}



?>
