<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$dbConn->query("INSERT INTO tbl_guests (guest_name,unit,contact_number,address,guest_type) VALUES ('".$_POST['guest_name']."','".$_POST['unit']."','".$_POST['contact_number']."','".$_POST['address']."','".$_POST['guest_type']."') ");


	$get  = $dbConn->query("SELECT * FROM tbl_guests where guest_name = '".$_POST['guest_name']."' ");
	$dis = $get->fetch(PDO::FETCH_ASSOC);

 $getprice = $dbConn->query("SELECT * FROM tbl_ameneties where ameneties_id = '".$_POST['room_id']."' ");
	    $disprice = $getprice->fetch(PDO::FETCH_ASSOC);

	$start = strtotime($_POST['from']);
$end = strtotime($_POST['to']);

$timediff = abs($end - $start);

$days  = $timediff / 86400;

$numbers = intval($days) + 1;

$payment = $numbers * $disprice['ameneties_price'];

	$dbConn->query("INSERT INTO tbl_reservations_am (room_id,datefrom,dateto,total_payment,guest_id) values ('".$_POST['room_id']."','".$_POST['from']."','".$_POST['to']."','".$payment."','".$dis['guest_id']."') ");

	$_SESSION['message'] = '<div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Reservation Has Been created.</span>
	                                    
	                                </div>';
	                                header("location:../reservations.php");

}



?>