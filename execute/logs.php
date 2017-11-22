<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit_IN'])) 
{

	$check = $dbConn->query("SELECT * FROM tbl_logs where unique_id = '".$_POST['unique']."' ");

	if ($check->rowCount() > 0) 
	{
		 $_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Guest already In!</strong>
									</div>';
		header("location:../monitoring-mp.php");
	
	}
		else
	{

		$dbConn->query("INSERT INTO tbl_logs (date_in,unique_id) VALUES ('".$_POST['now']."','".$_POST['unique']."') ");
		
		$dbConn->query("UPDATE tbl_guests SET status = 'IN' where unique_id = '".$_POST['unique']."' ");

		$_SESSION['message'] = ' <div class="alert alert-success">	                                   
	                                    <span><b> Success - </b> Guest Check In! </span>
	                              </div>';
		header("location:../monitoring-mp.php");
	

	}
				
}

elseif (isset($_POST['submit_OUT'])) 
{

	

	
	$dbConn->query("UPDATE tbl_logs SET date_out = '".$_POST['now']."' where unique_id = '".$_POST['unique']."'  ");

	$dbConn->query("UPDATE tbl_guests SET status = 'OUT' where unique_id = '".$_POST['unique']."' ");

	$_SESSION['message'] = ' <div class="alert alert-success">	                                   
	                                    <span><b> Success - </b> Guest has been Check out! </span>
	                              </div>';
		header("location:../monitoring-mp.php");

}


?>