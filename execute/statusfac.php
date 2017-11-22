<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	if ($_POST['status'] == 'enable') 
	{
		$dbConn->query("UPDATE tbl_facilities SET status = 'available' where facility_id = '".$_POST['facility_id']."'");

		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> ENABLED - </b> Facility ID : '.$_POST['facility_id'].'</span>
	                                </div>';
		header("location:../facilities.php");
	}

	if ($_POST['status'] == 'disable') 
	{
		$dbConn->query("UPDATE tbl_facilities SET status = 'disable' where facility_id = '".$_POST['facility_id']."'  ");
		$_SESSION['message'] =' <div class="alert alert-warning">
	                                    
	                                    <span><b> DISABLED - </b> Facility ID : '.$_POST['facility_id'].'</span>
	                                </div>';
		header("location:../facilities.php");
	}
}
?>