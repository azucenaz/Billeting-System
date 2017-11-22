<?php
include ("library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}
$_SESSION['active'] = 'request';
?>



<?php include("templates/header.php") ?>


<!-- Session Unset -->
<?php




?>

<body>
	<div class="wrapper">
	    <div class="sidebar" data-background-color="brown" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<a href="index.php" class="simple-text">
					Base Billeting System
				</a>
			</div>
			
	    	<div class="sidebar-wrapper">
				
	            <?php
	            switch ($_SESSION['type']) 
	            {
	            	case 'admin':
	            	include ("navigation/admin.php");
	            		break;
	            	case 'cashier':
	           		include ("navigation/cashier.php");
	            		break;
	            	case 'mp':
	            	include ("navigation/mp.php");
	            		break;
	            	default:
	            		header("location:login.php");
	            		break;
	            }

	            ?>
	    	</div>
	    </div>




	    <div class="main-panel">
			<nav class="navbar navbar-default">
	            <div class="container-fluid">


					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="fa fa-chevron-left"></i></button>
					</div>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar bar1"></span>
	                        <span class="icon-bar bar2"></span>
	                        <span class="icon-bar bar3"></span>
	                    </button>
	                    <a class="navbar-brand" href="#">
							Choose Reservation
						</a>
	                </div>


	                <?php
	                  include ("includes/navbar.php");
	                ?>
	                
	            </div>
	        </nav>

	        <div class="content">
	            <div class="container-fluid">
   <?php
	            	echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
	            	unset($_SESSION['message']);
	            	?>  	
	         
<div id="choosen" <?php if(isset($_SESSION['requesttype'])){echo 'hidden';} ?>>
	                <div class="row">




<!-- button for making room reservation -->
<div class = "col-md-12">

	<div class="col-md-4">
	             <div class="card">
	                 <div class="content text-center">


	                 <!-- picture of room -->
	                 <img src="assets/img/r1.jpg" width="248px" height="">
					                  			
	                <h5>Accomodation</h5>
	                   
	               	<div class="row">
	            		<div class="col-md-12" style="padding-bottom:10px;">

	            			<button class="btn btn-primary" id="accomodation">Register</button><br>

	            		</div>
	            	</div>

							

	        </div>
	        </div>
	  </div>



<div class="col-md-4">
	             <div class="card">
	                 <div class="content text-center">

	                 <!-- picture of billeiting -->
	                <img src="assets/img/b.jpg" width="290px" height="">
					                  			


	                <h5>Billeting</h5>
	                   
	               	<div class="row">
	            		<div class="col-md-12" style="padding-bottom:10px;">

	            			<button class="btn btn-primary" id="billeting">Register</button><br>


	            		</div>
	            	</div>

							

	        </div>
	        </div>
	  </div>


<div class="col-md-4">
	             <div class="card">
	                 <div class="content text-center">

	                 <!-- picture of amenetiy -->
	                 <img src="assets/img/a.jpg" width="200px" height="">
					                  			
	                <h5>Base Amenety Reservation</h5>
	                   
	               	<div class="row">
	            		<div class="col-md-12" style="padding-bottom:10px;">

	            			<button class="btn btn-primary" id="ameneties">Register</button><br>

	            		</div>
	            	</div>

							

	        </div>
	        </div>
	  </div>

</div>	



</div>
</div>


<!-- Request Room -->


	            			<div <?php 



	            			if (isset($_SESSION['requesttype']) && $_SESSION['requesttype'] == 'accomodation') 
	            			{
	            				echo "";
	            			}
	            			else
	            			{
	            				echo "hidden";
	            			}

	            			?>  id="requestroom">
					           <!--  <div class="modal-dialog ">
					              <div class="modal-content"> -->

		<h4 class="modal-title" id="myModalLabel" align="center">
  							Accomodation Request Form
  						</h4>
   <?php
	            	echo isset($_SESSION['message1']) ? $_SESSION['message1'] : '';
	            	unset($_SESSION['message1']);
	            	?>  				
					              	<form method="post" action="execute/search.php">
							            <div class="row">
							            <div class="col-md-12"> 
							            	<div class="col-md-6 col-md-offset-3">
							             		
							             		<input type="text" class="form-control" name="search" placeholder="Enter Serial number!" requried>
							             	</div>
							             	<div class="">	
							       				<button type="submit" name="btn_search"  class="btn btn-success btn-theme">Search</button> 
							       				
							             	</div>
							             </div>
							            </div> 
							           </form>



					                <form method="post" action="execute/request_room.php">
					                  <div class="modal-header">
					                    
					                  </div>
					                  <div class="modal-body">

						             

						               	
						             
					                      <div class="col-md-4">     
												<label class="col-md-3">From</label>
	            								<div class="col-md-12">
													<input type="text" class="form-control datepicker" required name="from" id="from">
	            								</div>
	            							</div>

	            							<div class="col-md-4">
	            								<label class="col-md-3">To</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control datepicker" required name="to" id="to">
	            								</div>
	            							</div>
	            					


	            					
											<div class="col-md-4">
	            								<label class="col-md-8">Guest Name</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control" required name="guest_name" value="<?php echo isset($_SESSION['guest_name']) ? $_SESSION['guest_name'] : ''; ?>" >
	            								</div>
	            							</div>	            							

	            						<div class="col-md-4">
	            								<!-- <label class="col-md-6">Rank</label> -->
	            								
	            								<div class="col-md-6">
	            								<label>Rank</label>
	            									<select class="form-control" required name="rank">
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'AM'){
	            											echo 'selected';
	            											} ?> value="AM">AM</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'A2C'){
	            											echo 'selected';
	            											} ?> value="A2C">A2C</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'A1C'){
	            											echo 'selected';
	            											} ?> value="A1C">A1C</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'SGT'){
	            											echo 'selected';
	            											} ?> value="SGT">SGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'SSGT'){
	            											echo 'selected';
	            											} ?> value="SSGT">SSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'TSGT'){
	            											echo 'selected';
	            											} ?> value="TSGT">TSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MSGT'){
	            											echo 'selected';
	            											} ?> value="MSGT">MSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'CMSGT'){
	            											echo 'selected';
	            											} ?> value="CMSGT">CMSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == ''){
	            											echo 'selected';
	            											} ?> value="2LT">2LT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == '2LT'){
	            											echo 'selected';
	            											} ?> value="1LT">1LT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'CPT'){
	            											echo 'selected';
	            											} ?> value="CPT">CPT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MAJ'){
	            											echo 'selected';
	            											} ?> value="MAJ">MAJ</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'LTCOL'){
	            											echo 'selected';
	            											} ?> value="LTCOL">LTCOL</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'COL'){
	            											echo 'selected';
	            											} ?> value="COL">COL</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'BGEN'){
	            											echo 'selected';
	            											} ?> value="BGEN">BGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MGEN'){
	            											echo 'selected';
	            											} ?> value="MGEN">MGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'LTGEN'){
	            											echo 'selected';
	            											} ?> value="LTGEN">LTGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'GEN'){
	            											echo 'selected';
	            											} ?> value="GEN">GEN</option>
	            									</select>
	            								</div>
	            							
	            								<div class="col-md-6">
	            								<label>BOS</label>
	            									<select class="form-control" required name="BOS">
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PAF'){
	            											echo 'selected';
	            											} ?> value="PAF">PAF</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PA'){
	            											echo 'selected';
	            											} ?> value="PA">PA</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PN'){
	            											echo 'selected';
	            											} ?> value="PN">PN</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PNP'){
	            											echo 'selected';
	            											} ?> value="PNP">PNP</option>
	            									</select>
	            								</div>
	            					
	            					

	            						
	            					</div>




											<div class="col-md-4">
	            								<label class="col-md-6">Guest Type</label>
	            								<div class="col-md-12">
	            									<select class="form-control" required name="guest_type">
	            										<option value="VIP">VIP</option>
	            										<option value="ACTIVE">ACTIVE</option>
	            										<option value="RETIRED">RETIRED</option>
	            										<option value="DEPENDENT">DEPENDENT</option>
	            										<option value="CIVILIAN">CIVILIAN</option>

	            									</select>
	            								</div>
	            							</div>	            							

	            							<div class="col-md-4">
	            							
	            								<label class="col-md-8">Serial number</label>
	            								<div class="col-md-12">
	            									<input type="number" class="form-control" required name="serial_number"
	            									value="<?php echo isset($_SESSION['serial_number']) ? $_SESSION['serial_number'] : ''; ?>" 
	            									>
	            								</div>
	            					
	            							</div>
	            							
	            							




	            							<div class="col-md-4 ">     
											<label class="col-md-8">Unit Assignment</label>
	            							<div class="col-md-12">
					                      		<input type="text" class="form-control" required name="unit" 
					                      		value="<?php echo isset($_SESSION['unit']) ? $_SESSION['unit'] : ''; ?>" 
					                      		>

					                   	 	</div>
					                 	
					                 	</div>
	            							
	            							<div class="col-md-4">
	            								<label class="col-md-12">Contact Number</label>
	            								<div class="col-md-12">
	            									<input type="number" class="form-control" required name="contact_number"
	            									value="<?php echo isset($_SESSION['contact_number']) ? $_SESSION['contact_number'] : ''; ?>" 
	            									>
	            								</div>
	            							</div>





					                 	<div class="col-md-4">
	            								<label class="col-md-4">Address</label>
	            								<div class="col-md-12">
	            									<textarea class="form-control" required name="address"><?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?> </textarea>
	            								</div>
	            							</div>
					                 	
										<input type="hidden" value="PENDING" name="stat">
	            							
	            					</div>

				                       
        
					                  <div class="modal-footer">
					                    <button type="button" id="back" class="btn btn-danger">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Submit</button>
					                  </div>
					                </form>
					             

					                  </div> 



<!-- Request Ameneties -->


	            			<div  id="requestamenety" <?php 



	            			if (isset($_SESSION['requesttype']) && $_SESSION['requesttype'] == 'ameneties') 
	            			{
	            				echo "";
	            			}
	            			else
	            			{
	            				echo "hidden";
	            			}

	            			?>>

  	<hr />				<h4 class="modal-title" id="myModalLabel" align="center">
  							Ameneties Request Form
  						</h4>
  				
  	<hr />
					              <!-- 	<form method="post" action="execute/search_am.php">
							            <div class="row">
							            <div class="col-md-12"> 
							            	<div class="col-md-6 col-md-offset-3">
							             		
							             		<input type="text" class="form-control" name="search" placeholder="Enter guests name!">
							             	</div>
							             	<div class="">	
							       				<button type="submit" name="btn_search"  class="btn btn-success btn-theme">Search</button> 
							       				
							             	</div>
							             </div>
							            </div> 
							           </form> -->


					                <form method="post" action="execute/request_amenety.php">
					                  <div class="modal-header">

					                   </div>
					                  <div class="modal-body">
					                   
					                   
		       
					                   <div class="row">

					                   	<div class="col-md-12">
					                       <div class="form-group">
					                      	<label class="col-md-8">Base Ameneties</label>
					                      	<select class="form-control" name="reserve_of" id="reserve_of" required>					                     					                      
					                      		<?php 
					                      		$query = $dbConn->query("SELECT * FROM tbl_ameneties");
					                      		while($row = $query->fetch(PDO::FETCH_ASSOC))
					                      		{
					                      		?>
					                      		<option value="<?php echo $row['ameneties_id']?>" ><?php echo $row['ameneties_name']?> - P <?php echo $row['ameneties_price']?></option>
					                      		<?php
					                      		}
					                      		?>

					                      	</select>
					                   	 	</div>
					                   	</div>

					                   	<input type="hidden" value="PENDING" name="stat">


					                   	
					                   	</div>
					             

					             <div class="row">

					             	<div class="row">
					                      <div class="col-md-6 col-offset-md-6">     
												<label class="col-md-3">From</label>
	            								<div class="col-md-12">
													<input type="text" class="form-control datepicker" required name="from" id="from">
	            								</div>
	            							</div>

	            							<div class="col-md-6">
	            								<label class="col-md-3">To</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control datepicker" required name="to" id="to">
	            								</div>
	            							</div>
	            					</div>

	            					<div class="row">
	            							<div class="col-md-6">
	            								<label class="col-md-6">Guest Name</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control" required name="guest_name" 
	            									value="<?php echo isset($_SESSION['guest_name_am']) ? $_SESSION['guest_name_am'] : ''; ?>"
	            									>
	            								</div>
	            							</div>

	            							<div class="col-md-6">
	            								<label class="col-md-8">Unit /  Department</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control" required name="unit"
	            									value="<?php echo isset($_SESSION['unit_am']) ? $_SESSION['unit_am'] : ''; ?>"
	            									>
	            								</div>
	            							</div>
	            					</div>

	            					<div class="row">
	            							<div class="col-md-6">
	            								<label class="col-md-8">Contact number</label>
	            								<div class="col-md-12">
	            									<input type="number" class="form-control" required name="contact_number"
	            									value="<?php echo isset($_SESSION['contact_number_am']) ? $_SESSION['contact_number_am'] : ''; ?>"
	            									>
	            								</div>
	            							</div>
											<div class="col-md-6">
	            								<label class="col-md-6">Guest Type</label>
	            								<div class="col-md-12">
	            									<select class="form-control" required name="guest_type">
	            										<option value="VIP">VIP</option>
	            										<option value="ACTIVE">ACTIVE</option>
	            										<option value="RETIRED">RETIRED</option>
	            										<option value="DEPENDENT">DEPENDENT</option>
	            										<option value="CIVILIAN">CIVILIAN</option>
	            									</select>
	            								</div>
	            							</div>	
	            					</div>

					                 <div class="row">

					                 	<div class="col-md-12">
	            								<label class="col-md-4">Address</label>
	            								<div class="col-md-12">
	            									<textarea class="form-control" required name="address"><?php echo isset($_SESSION['address_am']) ? $_SESSION['address_am'] : ''; ?></textarea>
	            								</div>
	            							</div>
					                 	
		
	            							
	            					</div>

	            							<input type="hidden" value="PENDING" name="stat">


					             </div> 

	   		                    
					                   
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" id="back1" class="btn btn-danger">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Submit</button>
					                  </div>
					                </form>
					              </div>


		            			<div id="requestbilleting" <?php 



	            			if (isset($_SESSION['requesttype']) && $_SESSION['requesttype'] == 'billeting') 
	            			{
	            				echo "";
	            			}
	            			else
	            			{
	            				echo "hidden";
	            			}

	            			?>>

				<h4 class="modal-title" id="myModalLabel" align="center">
  							Billet Request Form
  						</h4>
  <?php
	            	echo isset($_SESSION['message1']) ? $_SESSION['message1'] : '';
	            	unset($_SESSION['message1']);
	            	?>  	  				

					              	<form method="post" action="execute/search_billet.php">
							            <div class="row">
							            <div class="col-md-12"> 
							            	<div class="col-md-6 col-md-offset-3">
							             		
							             		<input type="text" class="form-control" name="search" placeholder="Enter serial  NUMBER!">
							             	</div>
							             	<div class="">	
							       				<button type="submit" name="btn_search"  class="btn btn-success btn-theme">Search</button> 
							       				
							             	</div>
							             </div>
							            </div> 
							           </form>


					                <form method="post" action="execute/request_billet.php">
					                  <div class="modal-header">

					                     </div>
					                  <div class="modal-body">
					                   
					                   <div class="row">
					                      

	            					<div class="row">

	            						<div class="col-md-6">
	            								<label class="col-md-8">Guest Name</label>
	            								<div class="col-md-12">
	            									<input type="text" class="form-control" required name="guest_name" 
	            									value="<?php echo isset($_SESSION['guest_name_billet']) ? $_SESSION['guest_name_billet'] : ''; ?>"
	            									>
	            								</div>
	            						</div>

	            						<div class="col-md-6">	            								

	            								<div class="col-md-6">
	            								<label>Rank</label>
	            									<select class="form-control" required name="rank">
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'AM'){
	            											echo 'selected';
	            											} ?> value="AM">AM</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'A2C'){
	            											echo 'selected';
	            											} ?> value="A2C">A2C</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'A1C'){
	            											echo 'selected';
	            											} ?> value="A1C">A1C</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'SGT'){
	            											echo 'selected';
	            											} ?> value="SGT">SGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'SSGT'){
	            											echo 'selected';
	            											} ?> value="SSGT">SSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'TSGT'){
	            											echo 'selected';
	            											} ?> value="TSGT">TSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MSGT'){
	            											echo 'selected';
	            											} ?> value="MSGT">MSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'CMSGT'){
	            											echo 'selected';
	            											} ?> value="CMSGT">CMSGT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == ''){
	            											echo 'selected';
	            											} ?> value="2LT">2LT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == '2LT'){
	            											echo 'selected';
	            											} ?> value="1LT">1LT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'CPT'){
	            											echo 'selected';
	            											} ?> value="CPT">CPT</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MAJ'){
	            											echo 'selected';
	            											} ?> value="MAJ">MAJ</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'LTCOL'){
	            											echo 'selected';
	            											} ?> value="LTCOL">LTCOL</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'COL'){
	            											echo 'selected';
	            											} ?> value="COL">COL</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'BGEN'){
	            											echo 'selected';
	            											} ?> value="BGEN">BGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'MGEN'){
	            											echo 'selected';
	            											} ?> value="MGEN">MGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'LTGEN'){
	            											echo 'selected';
	            											} ?> value="LTGEN">LTGEN</option>
	            										<option <?PHP if(isset($_SESSION['rank']) && $_SESSION['rank'] == 'GEN'){
	            											echo 'selected';
	            											} ?> value="GEN">GEN</option>
	            									</select>
	            								</div>
	            							
	            								<div class="col-md-6">
	            								<label>BOS</label>
	            									<select class="form-control" required name="BOS">
	            										
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PAF'){
	            											echo 'selected';
	            											} ?> value="PAF">PAF</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PA'){
	            											echo 'selected';
	            											} ?> value="PA">PA</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PN'){
	            											echo 'selected';
	            											} ?> value="PN">PN</option>
	            										<option <?PHP if(isset($_SESSION['BOS']) && $_SESSION['BOS'] == 'PNP'){
	            											echo 'selected';
	            											} ?> value="PNP">PNP</option>
	            									
	            									</select>
	            								</div>
	            							</div>

	            				
	            					</div>



	            					<div class="row">
											<div class="col-md-6">
	            								<label class="col-md-6">Guest Type</label>
	            								<div class="col-md-12">
	            									<select class="form-control" required name="guest_type">
	            										<option value="VIP">VIP</option>
	            										<option value="ACTIVE">ACTIVE</option>
	            										<option value="RETIRED">RETIRED</option>
	            										<option value="DEPENDENT">DEPENDENT</option>
	            										<option value="CIVILIAN">CIVILIAN</option>
	            									</select>
	            								</div>
	            							</div>	




	            							<div class="col-md-6">
	            							
	            								<label class="col-md-8">Serial number</label>
	            								<div class="col-md-12">
	            									<input type="number" class="form-control" required name="serial_number"
	            									value="<?php echo isset($_SESSION['serial_number_billet']) ? $_SESSION['serial_number_billet'] : ''; ?>"
	            									>
	            								</div>
	            					
	            							</div>
	            							
	            							

	            					</div>

	            					<div class="row">
	            							<div class="col-md-6 col-offset-md-6">     
											<label class="col-md-8">Unit Assignment</label>
	            							<div class="col-md-12">
					                      	<select class="form-control" name="unit" required>
                                                <option value="H2AD">Headquarters 2nd AD</option>
                                                <option value="560th ABW">560th ABW</option>
                                                <option value="205th THW">205th THW</option>
                                                <option value="220 AW">220 AW</option>                                                 
					                      	</select>
					                   	 	</div>
					                 	
					                 	</div>
	            							
	            							<div class="col-md-6">
	            								<label class="col-md-12">Contact Number</label>
	            								<div class="col-md-12">
	            									<input type="number" class="form-control" required name="contact_number"
	            									value="<?php echo isset($_SESSION['contact_number_billet']) ? $_SESSION['contact_number_billet'] : ''; ?>"
	            									>
	            								</div>
	            							</div>

					                 </div>

					                 <div class="row">

					                 	<div class="col-md-12">
	            								<label class="col-md-4">Address</label>
	            								<div class="col-md-12">
	            									<textarea class="form-control" required name="address"><?php echo isset($_SESSION['address_billet']) ? $_SESSION['address_billet'] : ''; ?></textarea>
	            								</div>
	            							</div>
					                 	
		
	            							
	            					</div>


					             </div> 



					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" id="back2" class="btn btn-danger">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Submit</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>



<?php unset($_SESSION['requesttype']); 
unset($_SESSION['from'],$_SESSION['guest_name'],$_SESSION['to'],$_SESSION['serial_number'],$_SESSION['guest_type'],$_SESSION['rank'],$_SESSION['BOS'],$_SESSION['unit'],$_SESSION['contact_number'],$_SESSION['address'],$_SESSION['guest_name_billet'],$_SESSION['serial_number_billet'],$_SESSION['contact_number_billet'],$_SESSION['address_billet']);

?>




					 </div>
                </div>
	        </div>

            <?php include ("/templates/footer.php"); ?>

	    </div>
	</div>

   
	
</body>

    <!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!-- Vector Map plugin -->
	<script src="assets/js/jquery-jvectormap.js"></script>


    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

    <!--   Sharrre Library    -->
    <script src="assets/js/jquery.sharrre.js"></script>

    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="assets/js/jquery.datatables.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="assets/js/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="assets/js/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="assets/js/bootstrap-selectpicker.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {

	    	$('.update').click( function()
	    	{
	    		$('#card').css('z-index',0);
	    		$('.navbar').css('z-index',0);
	    		
	    	});

	    	

	    	$('.datepicker').on('click',function()
	    	{
	    		$('#card').css('z-index',4);
	    	});

	    	$('.submit').on('click',function()
	    	{
	    		$('#card').css('z-index',4);
	    	});

	        $('#datatables').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
		        }
	        });

         $('#from,#to').datetimepicker({format: 'YYYY-MM-DD',
            minDate : new Date(),    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'}});
	    });
		
		$("#accomodation").click(function()
		{
			$("#requestroom").show();
			$("#choosen").hide();
		});
		$("#ameneties").click(function()
		{
			$("#requestamenety").show();
			$("#choosen").hide();
		});


		$("#billeting").click(function()
		{
			$("#requestbilleting").show();
			$("#choosen").hide();
		});

		$("#back").click(function()
		{
			$("#choosen").show();
			$("#requestbilleting").hide();
			$("#requestamenety").hide();

			$("#requestroom").hide();
		});
		$("#back1").click(function()
		{
			$("#choosen").show();
			$("#requestbilleting").hide();
			$("#requestamenety").hide();

			$("#requestroom").hide();
		});
		$("#back2").click(function()
		{
			$("#choosen").show();
			$("#requestbilleting").hide();
			$("#requestamenety").hide();

			$("#requestroom").hide();
		});

	</script>

</html>
