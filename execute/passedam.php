<?php
include '../library/connection.php';
session_start();

$dbConn->query("UPDATE tbl_reservations SET status = 'APPROVE' where reservation_id = '".$_POST['reservation_id']."'  ");
$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Request Ameneties approved.</span>
	                                </div>';
header("location:../reservations.php");

?>