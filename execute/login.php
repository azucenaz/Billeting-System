<?php
include '../library/connection.php';
session_start();
if (isset($_POST['submit'])) 
{

	$check = $dbConn->query("SELECT * FROM tbl_users where username = '".$_POST["username"]."' AND password = '".$_POST["password"]."' " );
	if ($check->rowCount() > 0) 
	{
		$row = $check->fetch(PDO::FETCH_ASSOC);
		if ($row['type'] == 'mp' AND  $row['status'] == 'active') 
		{

			
			$_SESSION['user_id'] =  $row['user_id'];
			$_SESSION['fullname'] = $row['fullname'];
			$_SESSION['type'] = $row['type'];
			header("location:../request-mp.php");

		}
		elseif ($row['type'] == 'admin' AND  $row['status'] == 'active') {

			$_SESSION['user_id'] =  $row['user_id'];
			$_SESSION['fullname'] = $row['fullname'];
			$_SESSION['type'] = $row['type'];
			header("location:../index.php");
		}
		elseif ($row['type'] == 'cashier' AND  $row['status'] == 'active') {
			$_SESSION['user_id'] =  $row['user_id'];
			$_SESSION['fullname'] = $row['fullname'];
			$_SESSION['type'] = $row['type'];
			header("location:../index.php");
		}
		else 
		{

			$_SESSION['message'] = '<div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Youre account is not active!</span>
	                                </div>';
			header("location:../login.php");
			
			
		}
		

	}
	else
	{	
		$_SESSION['message'] = '<div class="alert alert-danger">
	                                    
	                                    <span><b> Error - </b> Invalid Username or Password.</span>
	                                </div>';
		header("location:../login.php");
	}

	

	

}

?>