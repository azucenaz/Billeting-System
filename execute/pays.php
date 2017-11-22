<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{	
	$change = $_POST['amount'] - $_POST['price'];
	$dbConn->query("UPDATE tbl_reservations SET status = 'PAID' where reservation_id = '".$_POST['reservation_id']."' ");
	// $dbConn->query("UPDATE tbl_guests SET status = 'paid' where unique_id = '".$_POST['unique']."' ");



	$dbConn->query("INSERT INTO tbl_transactions  (guest_id,total_payment,change1,amount_tender,room_id,date_payment) VALUES ('".$_POST['guest_id']."','".$_POST['price']."','".$change."','".$_POST['amount']."','".$_POST['room_id']."','".date('Y-m-d')."')  ");
	$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Reservation - </b> paid</span>
	                                    
	                                </div>';
	header("location:../transactions.php");
}

?>