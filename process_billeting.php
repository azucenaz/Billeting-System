<?php
include ("library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = 'process_reservation_Facilities';

?>

<?php include("templates/header.php") ?>

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
	            	include 'navigation/admin.php';
	            		break;
	            	case 'cashier':
	           		include 'cashier.php';
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
							Facilities Reservation
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
	            	<div class="modal fade" id="avail">
					            <div class="modal-dialog ">
					              <div class="modal-content">
					              
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">RESERVE</h4>
					                  </div>
					                  <div class="modal-body">

					                  	<!-- data values  -->
					                 
					                      		                      
					                    </div>
					                    <div class="row">
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Guest Information</label>
					                          
					                        </div>
					                      </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-md-6">
					                    		<div class="form-group">
					                    			<input type="text" name="guest_name" placeholder="Rank/Name/Serial_no./BOS" class="form-control" required>
					                    		</div>
					                    	</div>

					                      <div class="col-md-6">
					                        <div class="form-group">
					                         
					                          <input type="number" name="contact_number" placeholder="Contact Number" class="form-control" required>
					                        </div>
					                      </div>
					                    </div>
					                     <div class="row">
					                    	

					                      <div class="col-md-6">
					                        <div class="form-group">
					                         
					                          <input type="text" name="address" placeholder="Address" class="form-control" required>
					                        </div>
					                      </div>

					                       <div class="col-md-6">
					                        <div class="form-group">
					                         
					                          <input type="text" name="unit" placeholder="Unit Assignment" class="form-control" required>
					                        </div>
					                      </div>

					                    </div>
					                     <div class="row">
					                    	
					                     
					                    </div>
					                    
					                   
					                    
					                   
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">RESERVED</button>
					                  </div>
					           
					              </div>
					            </div>
					          </div>

	            	<div class="row">
	            		<div class="container-fluid">
	            		<div class="card" id="card" style="z-index:5;">
	            			<div class="content clearfix">

	           				<div class="col-md-12">
					            <div class="form-group">

	            					<p class="col-md-4"><label>Guest Name:</label> <?php echo isset ($_SESSION['guest_name']) ? $_SESSION['guest_name']:''; ?></p>
	            					
	            					<p class="col-md-4"><label>Unit Assignment:</label> <?php echo isset ($_SESSION['unit']) ? $_SESSION['unit']:''; ?></p>
	            				
	            					<p class="col-md-4"><label>Guest Type:</label> <?php echo isset ($_SESSION['g_type']) ? $_SESSION['g_type']:''; ?></p>

	            					<?php 

	            					if(isset($_SESSION['true']) && $_SESSION['true'] == 'true')
	            					{

	            					?>

	            						<form method="post" action="execute/payment2.php">
	            					  	<input type="hidden" value="<?php echo isset($_SESSION['room_id']) ? $_SESSION['room_id']: '' ?>" name="facility_id">
<!-- 					                   	<input type="hidden" value="<?php echo isset($_SESSION['payment']) ? $_SESSION['payment']: '' ?>" name="payment">
 -->					                   		<input type="hidden" value="<?php echo isset($_SESSION['room_no']) ? $_SESSION['room_no']: '' ?>" name="room_no">
					                   	
					                   	<!-- end data values -->
					                   
					                      	<p class="col-md-4">     
					                      		<label>Room Number:</label>
					                          		<?php echo isset($_SESSION['room_no']) ? $_SESSION['room_no']: '' ?></p>
					                     	                      
					                  
					                    	<p class="col-md-4">      
					                    		<label>Billet Name: </label>
					                          		<?php echo isset($_SESSION['room_name']) ? $_SESSION['room_name']: '' ?></p>

					                 		 <p class="col-md-4">      
					                 		 	<label>Type: </label>
					                          		<?php echo isset($_SESSION['type1']) ? $_SESSION['type1']: '' ?></p>
					                          <input type="hidden" name="category" value="<?php echo isset($_SESSION['type1']) ? $_SESSION['type1']: '' ?>">

					                  		 <p class="col-md-offset-8 col-md-4">
					                  		 	
					                  		 	<button class="btn btn-success btn-lg" type="submit" name="submit">RESERVE</button>

					                  		 </p>
					                  		 
					                  	<?php
					                  	unset($_SESSION['true']);
					                  }
					                  ?>
	            					</form>

	            				</div>
	            				</div>
							</div>
	            		</div>
	            		</div>
	            </div>






	            	<div class="row">
	            		<div class="container-fluid">
	            		<div class="card" id="card" style="z-index:5;">
	            			<div class="content clearfix">

								


	            				<form method="post" action="execute/check1.php" >
	            				
	            					
	            				<h5 >Create Billeting Assignment!</h5>

	            		
	            					<input type="hidden" value="<?php echo $_SESSION['assign_id']?>" name="assign_id" >
	            					<input type="hidden" class="form-control" value="<?php echo $_SESSION['from'];?>" required name="from" >
	            				
	            		
	            				
	            					<input type="hidden" class="form-control" value="<?php echo $_SESSION['to']?>" required name="to"  >
	            			

	            				<div class="col-md-4">
	            				<label class="col-md-12">Type: <span id="label">
	            								            								
	            				</span></label>
	            				<input type="hidden" class="form-control" value="" required name="type" id="type">
	            				</div>
	            				
	            				<div class="col-md-4" >

	            					<input type="hidden" class="form-control" required name="room_id" id="facility_id" align="center">					
	            					<input type="text" readonly class="form-control" required name="facility_name1" id="facility_name1" placeholder="Billet Name" align="center">
	            				</div>

	            				<div class="col-md-4">
	            					<input type="number" min="1" max="" class="form-control" placeholder="" required id="room_no" name="room_no">
	            				</div>

	            				<div class="col-md-offset-4 col-md-4"><br>
	            					<button class="btn btn-block btn-primary submit" style="display:none;" id="avail1" type="submit" name="submit">AVAIL</button>

	            					<a class="btn btn-block btn-danger" style="cursor:default;" name="submit" id="hidethis">PLEASE SELECT FIRST FACILITY</a>
	            				</div>
	            				</form>
	            			</div>
	            		</div>
	            		</div>
	            	</div>


	            	<div class="nav-tabs-navigation">
				                        <div class="nav-tabs-wrapper">
					                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					                            <li class="active"><a href="#home" data-toggle="tab">Quarters</a></li>
					                            <li><a href="#profile" data-toggle="tab">Barracks</a></li>
					                           
					                        </ul>
				                        </div>
				                    </div>

	            	
				                     <div id="my-tab-content" class="tab-content text-center">
				                        <div class="tab-pane active" id="home">


	                <div class="row">
	                    <div class="col-md-12">
							
	                        <div class="card">
	                            <div class="content">
	                                <div class="toolbar">
	                                   
	                                </div>
                                    <div class="fresh-datatables">
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>Quarters Name</th>
												<th>Rooms Number</th>
												<th>Status</th>
												
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										
										<tbody align="left">
											
											<?php
											$users = $dbConn->query("SELECT * FROM tbl_quarters");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
											?>
											<tr>

												
												<td><?php echo $row['quarters_name']?></td>
												
												
												<td>1 - <?php echo $row['room_number'] ?></td>
												


												<td>
												<?php if ($row['status'] == 'Available') 
												{
													echo '<span class="label label-success">AVAILABLE</span>';
												}
												else
												{
													echo '<span class="label label-danger">NOT AVAILABLE</span>';
												}
												?>
												</td>

												<td>
													<button class="btn btn-info btn-sm selectroom"  data-facilityid="<?php echo $row['quarters_id']?>" data-facilityname="<?php echo $row['quarters_name'];?>" data-numberrooms="<?php echo $row['room_number'];?>" data-type="Quarters">	SELECT
													</button>


												</td>

											</tr>

							<div class="modal fade" id="times<?php echo $row['facility_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/statusfac.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['facility_id']?>" name="facility_id">
					                  	<input type="hidden" value="disable" name="status">
					                   	Disable Facility ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                  	<button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

					          <div class="modal fade" id="check<?php echo $row['facility_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/statusfac.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['facility_id']?>" name="facility_id">
					                  	<input type="hidden" value="enable" name="status">
					                   Enable Facility ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                    
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>

					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

																
											<?php
											}
											?>
											
										   </tbody>
									    </table>
									</div>



	                            </div>
	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->
	                </div></div> <!-- end row -->
	                  <div class="tab-pane" id="profile">


	                <div class="row">
	                    <div class="col-md-12">
							
	                         <div class="card">
	                            <div class="content">
	                                <div class="toolbar">
	                                   
	                                </div>
                                    <div class="fresh-datatables">
										<table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>Barracks Name</th>
												<th>Rooms Number</th>
												<th>Status</th>
												
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										
										<tbody align="left">
											
											<?php
											$users = $dbConn->query("SELECT * FROM tbl_barracks");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
											?>
											<tr>

												
												<td><?php echo $row['barracks_name']?></td>
												
												
												<td>1 - <?php echo $row['bunks_number'] ?></td>
												


												<td>
												<?php if ($row['status'] == 'Available') 
												{
													echo '<span class="label label-success">AVAILABLE</span>';
												}
												else
												{
													echo '<span class="label label-danger">NOT AVAILABLE</span>';
												}
												?>
												</td>

												<td>
													<button class="btn btn-info btn-sm selectroom"  data-facilityid="<?php echo $row['barracks_id']?>" data-facilityname="<?php echo $row['barracks_name'];?>" data-numberrooms="<?php echo $row['room_number'];?>" data-type="Barracks">	SELECT
													</button>


												</td>

											</tr>

							<div class="modal fade" id="times<?php echo $row['facility_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/statusfac.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['facility_id']?>" name="facility_id">
					                  	<input type="hidden" value="disable" name="status">
					                   	Disable Facility ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                  	<button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

					          <div class="modal fade" id="check<?php echo $row['facility_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/statusfac.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['facility_id']?>" name="facility_id">
					                  	<input type="hidden" value="enable" name="status">
					                   Enable Facility ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                    
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>

					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

																
											<?php
											}
											?>
											
										   </tbody>
									    </table>
									</div>



	                            </div>
	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->
	                </div></div>
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

	    	$("#avail1").hide();
	    	$(".selectroom").click( function()
	    	{
	    		var facility_name = $(this).data("facilityname");
	    		var facility_id = $(this).data("facilityid");
	    		var	rooms_count = $(this).data("numberrooms");
	    		var type = $(this).data("type");

	    		$("#facility_name1").val(facility_name);
	    		$("#facility_id").val(facility_id);

	    		$("#label").html(type);
	    		$("#type").val(type);
	    		$("#avail1").show();
	    		$("#hidethis").hide();
	    		$("#room_no").attr('max',rooms_count);
	    	});

	    	$('.datepicker').on('click',function()
	    	{
	    		$('#card').css('z-index',4);
	    	});

	    	$('.submit').on('click',function()
	    	{
	    		$('#card').css('z-index',4);
	    	});


	    	

	    

	        $('#datatables,#datatables1').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
		        }
	        });

            // Init DatetimePicker
          

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
	</script>

</html>
