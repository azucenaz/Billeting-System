<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE tbl_users SET status = 'inactive' where user_id = '".$_POST['user_id']."' ");
	$_SESSION['message'] = '<div class="alert alert-danger">
	                                    
	                                    <span><b> Danger - </b>User account is inactive!</span>
	                                </div>';

	header("location:../users.php");
}
?>