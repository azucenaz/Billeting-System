<?php
include '../library/connection.php';
session_start();


if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE tbl_reservations SET status = 'CANCEL' where reservation_id = '".$_POST['reservation_id']."' ");
	
	$dbConn->query("UPDATE tbl_guests SET status = 'CANCEL' where unique_id = '".$_POST['unique_id']."' ");

	$_SESSION['message'] =' <div class="alert alert-warning">
	                                    
	                                    <span><b> Reservation - </b> has been canceled</span>
	                                    
	                                </div>';
	header("location:../reservations.php");
}

?>

