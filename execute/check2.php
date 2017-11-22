<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
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

	    $_SESSION['room_id'] = $_POST['barracks_id'];
	    $_SESSION['room_name'] = $disprice['barracks_name'];
	    $_SESSION['room_no'] = $_POST['room_no'];
	    $_SESSION['from'] = $_POST['from'];
	    $_SESSION['to'] = $_POST['to'];
	    
			header("location:../process_billeting.php");
	  
	}
}



?>
