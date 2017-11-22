

<?php

session_start();

$_SESSION['assign_id'] = isset($_POST['assign_id']) ? $_POST['assign_id'] : '';
	            						$_SESSION['guest_name'] = isset($_POST['guest_name']) ? $_POST['guest_name'] : '';
	            						$_SESSION['rank'] = isset($_POST['rank']) ? $_POST['rank'] : '';
										$_SESSION['BOS'] = isset($_POST['BOS']) ? $_POST['BOS'] : '';
										$_SESSION['serial_number'] = isset($_POST['serial_number']) ? $_POST['serial_number'] : '';
	            						$_SESSION['unit'] = isset($_POST['unit']) ? $_POST['unit'] : '';
	            						$_SESSION['g_type'] = isset($_POST['g_type']) ? $_POST['g_type'] : '';
header("location:../process_billeting.php");


?>
