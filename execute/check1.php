<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	if ($_POST['type'] == 'Quarters') 
	{
		$check = $dbConn->query("SELECT * FROM tbl_assign where category = 'quarters' and assign_number = '".$_POST['room_no']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Room number reservation already exist.</span>
	                                </div>';
	 
			header("location:../process_billeting.php");
	  
	}
	else
	{
		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Available! - </b>.</span>
	                                    
	                                </div>';

	     // Get room price

	    $getprice = $dbConn->query("SELECT * FROM tbl_quarters where quarters_id = '".$_POST['room_id']."' ");
	    $disprice = $getprice->fetch(PDO::FETCH_ASSOC);

	  
	$_SESSION['true'] = 'true';

		$_SESSION['payment'] = $numbers * $disprice['price'];
		$_SESSION['type1'] = 'quarters';
	    $_SESSION['room_id'] = $_POST['quarters_id'];
	    $_SESSION['room_name'] = $disprice['quarters_name'];
	    $_SESSION['room_no'] = $_POST['room_no'];
	    
			header("location:../process_billeting.php");
	  
	}
	}
	else
	{
		$check = $dbConn->query("SELECT * FROM tbl_assign where category = 'barracks' and assign_number = '".$_POST['room_no']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Room number reservation already exist.</span>
	                                </div>';
	 
			header("location:../process_billeting.php");
	  
	}
	else
	{
		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Available - </b> This facility is available that time.</span>
	                                    
	                                </div>';

	     // Get room price

	    $getprice = $dbConn->query("SELECT * FROM tbl_barracks where barracks_id = '".$_POST['room_id']."' ");
	    $disprice = $getprice->fetch(PDO::FETCH_ASSOC);

	  
	$_SESSION['true'] = 'true';

$_SESSION['payment'] = $numbers * $disprice['price'];
		$_SESSION['type1'] = 'barracks';
	    $_SESSION['room_id'] = $_POST['barracks_id'];
	    $_SESSION['room_name'] = $disprice['barracks_name'];
	    $_SESSION['room_no'] = $_POST['room_no'];
	    
			header("location:../process_billeting.php");
	  
	}
	}
}



?>
