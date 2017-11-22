<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{


		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);


	    $dbConn->query("UPDATE tbl_ameneties SET ameneties_name = '".$_POST['name']."',ameneties_image = '".$photo."',ameneties_description = '".$_POST['description']."',ameneties_status = '".$_POST['status']."',ameneties_price = '".$_POST['price']."' where ameneties_id = '".$_POST['id']."' ");                      

	    	header("location:../ameneties.php");
	    	$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	        <span><b> Facility ID: '.$_POST['id'].' - </b> Amenety has been updated!</span>
	                              </div>';

		
	}
	

?>