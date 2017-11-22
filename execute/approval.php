<?php

include '../connection.php';
session_start();
if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE tbl_reservations SET status = 'approved' where reservation_id = '".$_POST['reservation_id']."' ");
	$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Reservation - </b> has been approved</span>
	                                    
	                                </div>';
	header("location:../reservations.php");
}


?>