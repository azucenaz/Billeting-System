<?php
include '../library/connection.php';
session_start();
if(isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_facilities where facility_name = '".$_POST['room_name']."' AND facility_id != '".$_POST['room_id']."'");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] =' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Room name already exist.</span>
	                                </div>';
		header("location:../facilities.php");
	}
	else
	{
		$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	                                    <span><b> Room ID: '.$_POST['room_id'].' - </b> Room has been updated</span>
	                                </div>';
	    $dbConn->query("UPDATE tbl_facilities SET class = '".$_POST['class']."', facility_name = '".$_POST['room_name']."',price = '".$_POST['price']."',room_type = '".$_POST['type']."',occupants = '".$_POST['occupants']."' where facility_id = '".$_POST['room_id']."' ");                            
		header("location:../facilities.php");
	}
}
?>