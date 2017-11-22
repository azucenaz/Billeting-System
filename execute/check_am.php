<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_reservations WHERE datefrom <= '".$_POST['from']."' AND dateto >= '".$_POST['from']."' AND room_id = '".$_POST['room_id']."' AND status = 'APPROVE' || status = 'PAID'  ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Amenety Already Reserved!</span>
	                                </div>';
	 
			header("location:../reservations.php");
	  
	}
	else
	{

		$getprice = $dbConn->query("SELECT * FROM tbl_ameneties where ameneties_id = '".$_POST['room_id']."' ");
	    $disprice = $getprice->fetch(PDO::FETCH_ASSOC);

	    // compute price
	    $start = strtotime($_POST['from']);
		$end = strtotime($_POST['to']);

		$timediff = abs($end - $start);

		$days  = $timediff / 86400;

		$numbers = intval($days) + 1;

			$_SESSION['true'] = 'true';

		$_SESSION['payment'] = $numbers * $disprice['ameneties_price'];

	    // $_SESSION['room_id'] = $_POST['room_id'];
	    // $_SESSION['room_name'] = $disprice['ameneties_name'];
	    // $_SESSION['room_no'] = $_POST['room_no'];
	    // $_SESSION['from'] = $_POST['from'];
	    // $_SESSION['to'] = $_POST['to'];


		$dbConn->query("UPDATE tbl_reservations SET status = 'APPROVE',room_id = '".$_POST['room_id']."',total_payment ='".$_SESSION['payment']."' where reservation_id = '".$_POST['reservation_id']."'   ");

		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Available - </b> Amenety is available at that date.</span>
	                                    
	                                </div>';
	                                  
	                                header("location:../approve.php");

	
	  
	}
}



?>
