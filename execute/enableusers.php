<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE tbl_users SET status = 'active' where user_id = '".$_POST['user_id']."' ");
	$_SESSION['message'] = '<div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b>User account has been enabled.</span>
	                                </div>';
	header("location:../users.php");
}
?>