<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{
	if ($_POST['password'] == $_POST['repassword']) 
	{
		$dbConn->query("UPDATE tbl_users SET username = '".$_POST['username']."',password = '".$_POST['password']."',type = '".$_POST['type']."',fullname = '".$_POST['fullname']."'  where user_id = '".$_POST['user_id']."' ");
		$_SESSION['message'] ='<div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b>account has been updated.</span>
	                                </div>';
		header("location:../users.php");
	}
	else
	{
		$_SESSION['message'] = ' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b>Password Doesnt Match.</span>
	                                </div>';
		header("location:../users.php");
	}
	
}

?>