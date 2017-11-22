<?php
include '../connection.php';
session_start();
if (isset($_POST['submit'])) 
{

	$check = $dbConn->query("SELECT facility_name FROM tbl_facilities where facility_name = '".$_POST['name']."' ");

	if ($check->rowCount() > 0) 
	{
		 $_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Exist!</strong>
									</div>';
												header("location:../facilities.php");
	}
	else
	{
		 $photo = $_FILES['photo']['name'];
		 $target = "../assets/img/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
     	 
     	 $dbConn->query("INSERT INTO tbl_facilities (facility_name,facility_image,facility_description,facility_capacity,facility_status,facility_price,rooms_count) VALUES ('".$_POST['name']."','".$photo."','".$_POST['description']."','".$_POST['capacity']."','AVAILABLE','".$_POST['price']."','".$_POST['room_no']."') ");
     	 $_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> New facilities added.
									</div>';
								
		$getroom = $dbConn->query("SELECT * FROM tbl_facilities where facility_name = '".$_POST['name']."' ");
		$disroom = $getroom->fetch(PDO::FETCH_ASSOC);

		$dbConn->query("INSERT INTO tbl_rank_allowed (facilties_id,AM,A2C,A1C,SGT,SSGT,TSGT,MSGT,CMSGT,2LT,1LT,CPT,MAJ,LTCOL,COL,BGEN,MGEN,LTGEN,GEN) VALUES ('".$disroom['facility_id']."','".$_POST['am']."','".$_POST['a2c']."','".$_POST['a1c']."','".$_POST['sgt']."','".$_POST['ssgt']."','".$_POST['tsgt']."','".$_POST['msgt']."','".$_POST['cmsgt']."','".$_POST['2lt']."','".$_POST['1lt']."','".$_POST['cpt']."','".$_POST['maj']."','".$_POST['ltcol']."','".$_POST['col']."','".$_POST['bgen']."','".$_POST['mgen']."','".$_POST['ltgen']."','".$_POST['gen']."') ");
	header("location:../facilities.php");

// 		echo '1.'.$_POST['am'];
// 		echo '<br>2.'.$_POST['a2c'];
// $_SESSION['ranks'] = 'AM';
// 		 $sql = "SELECT * FROM tbl_rank_allowed WHERE ".$_SESSION['ranks']." = '1' AND facilties_id = '1'";
		

// 			$rowCount = $dbConn->query($sql);
// 			echo $rowCount->rowCount();

		#

	}

}

?>

