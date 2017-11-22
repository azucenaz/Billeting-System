<?php
include '../library/connection.php';
session_start();

if (isset($_POST['submit'])) 
{


		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);


	    $dbConn->query("UPDATE tbl_facilities SET facility_name = '".$_POST['name']."',facility_image = '".$photo."',facility_description = '".$_POST['description']."',facility_capacity = '".$_POST['capacity']."',facility_status = '".$_POST['status']."',facility_price = '".$_POST['price']."',rooms_count = '".$_POST['rooms_no']."' where facility_id = '".$_POST['id']."' ");                      


	    	$_SESSION['message'] =' <div class="alert alert-success">
	                                    
	        <span><b> Facility ID: '.$_POST['id'].' - </b> Facility has been updated!</span>
	                              </div>';

	     $dbConn->query("UPDATE tbl_rank_allowed SET AM = '".$_POST['am']."',A2C = '".$_POST['a2c']."',A1C = '".$_POST['a1c']."',SGT = '".$_POST['sgt']."',SSGT = '".$_POST['sgt']."',TSGT = '".$_POST['tsgt']."',MSGT = '".$_POST['msgt']."',CMSGT = '".$_POST['cmsgt']."',2LT = '".$_POST['2lt']."',1LT = '".$_POST['1lt']."',CAP = '".$_POST['cap']."',MAJ = '".$_POST['maj']."',LTCOL = '".$_POST['ltcol']."',COL = '".$_POST['col']."',BGEN = '".$_POST['BGEN']."',MGEN = '".$_POST['MGEN']."',LTGEN = '".$_POST['ltgen']."',GEN = '".$_POST['gen']."' where facilties_id = '".$_POST['id']."' ");


		header("location:../facilities.php");
	}
	

?>