<?php
include '../library/connection.php';
session_start();
if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_users where username = '".$_POST['username']."'");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] = ' <div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Account already exist.</span>
	                                </div>';
		header("location:../users.php");
	}
	else
	{
		if ($_POST['password'] == $_POST['repassword']) 
		{
		$_SESSION['message'] = ' <div class="alert alert-success">
	                                    
	                                    <span><b> Success - </b>New users added.</span>
	                                </div>';
		$dbConn->query("INSERT INTO tbl_users (username,password,type,status,fullname) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['type']."','active','".$_POST['fullname']."') ");
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
}
?>