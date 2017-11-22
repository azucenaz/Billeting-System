<?php

session_start();

										$_SESSION['reservation_id'] = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : '';
										$_SESSION['rank'] = isset($_POST['rank']) ? $_POST['rank'] : '';
										$_SESSION['BOS'] = isset($_POST['BOS']) ? $_POST['BOS'] : '';
										$_SESSION['serial_number'] = isset($_POST['serial_number']) ? $_POST['serial_number'] : '';
										$_SESSION['unique_id'] = isset($_POST['unique_id']) ? $_POST['unique_id'] : '';
	            						$_SESSION['guest_name'] = isset($_POST['guest_name']) ? $_POST['guest_name'] : '';
	            						$_SESSION['from'] = isset($_POST['from']) ? $_POST['from'] : '';
	            						$_SESSION['to'] = isset($_POST['to']) ? $_POST['to'] : '';

header("location:../process_reservation_Facilities.php");


?>