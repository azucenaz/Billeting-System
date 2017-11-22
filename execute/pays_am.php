<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{	
	$change = $_POST['amount'] - $_POST['price'];
	$dbConn->query("UPDATE tbl_reservations SET status = 'PAID' where reservation_id = '".$_POST['reservation_id']."' ");

	$dbConn->query("INSERT INTO tbl_transactions_am  (guest_id,total_payment,change1,amount_tender,room_id,date_payment) VALUES ('".$_POST['guest_id']."','".$_POST['price']."','".$change."','".$_POST['amount']."','".$_POST['room_id']."','".date('Y-m-d')."')  ");
	$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Reservation - </b> Paid</span>
	                                    
	                                </div>';
	header("location:../transactions.php");
}

?>