<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	

	$dbConn->query("UPDATE tbl_assign SET status = 'approve',billet_name = '".$_SESSION['room_name']."', assign_number = '".$_POST['room_no']."',category = '".$_POST['category']."' where assign_id = '".$_SESSION['assign_id']."'   ");

	$_SESSION['message'] = '<div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b> Assign Has Been created.</span>
	                                    
	                                </div>';
	                                header("location:../billeting.php");

}



?>