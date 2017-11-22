<?php
include ("./library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = 'guestlist';

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
							Guest Reservation list
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
												<th>Passcode</th>
												<th>Source</th>
												<th>Guest Name</th>
												<th>From - To </th>
												<th>Request Type</th>
												<th>Room No</th>
												<th>Status</th>
												
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										
										<tbody align="left">
											
											<?php
											$date = date("Y-m-d");

											$users = $dbConn->query("SELECT * FROM tbl_reservations where status = 'paid' ");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
												
											?>
											<tr data-toggle="modal" data-target="#">

												<td>
													<?php $getname = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$dis = $getname->fetch(PDO::FETCH_ASSOC);
													echo $dis['unique_id'];
													?>

												</td>

												<td>
													<?php $getname1 = $dbConn->query("SELECT * FROM tbl_users where user_id = '".$row['user_id']."' ");
													$dis1 = $getname1->fetch(PDO::FETCH_ASSOC);
													echo $dis1['fullname'];
													?>

												</td>


												<td>
													<?php $getname = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$dis = $getname->fetch(PDO::FETCH_ASSOC);
													echo $dis['guest_name'];
													?>
												</td>

												<td>
													<label font-style="bold">	<?php echo $row['datefrom']?> - <?php echo $row['dateto'] ?>	</label>
												</td>
												

												<td>
													<?php echo ucfirst($row['type']);?>
												</td>
												
												<td>
													<?php echo $row['room_no']?>
												</td>

												<td>
												<?php if ($row['status'] == 'PAID') 
												{
													echo '<span class="label label-success">PAID</span>';
												}
												else
												{
													echo '<span class="label label-info">PENDING</span>';
												}
												?>
												</td>



												<td>

													<?php $check = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$dis = $check->fetch(PDO::FETCH_ASSOC);

													if ($dis['status']=='PENDING') {
														
													?>

														<button class="btn btn-success btn-sm warning" data-target="#in<?php echo $row['reservation_id']?>" data-toggle="modal">
															Check-in
														</button>
													<?php } elseif ($dis['status']=='IN') {
													?>

														<button class="btn btn-warning btn-sm warning" data-target="#out<?php echo $row['reservation_id']?>" data-toggle="modal">
															Check-out
														</button>

													<?php } else {  echo $dis['status'];?>

														<?php } ?>
												</td>
											</tr>
<!-- IN -->
							<div class="modal fade" id="in<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/logs.php" align="center">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel" align="center">Information!</h4>
					                  </div>

					                  <div class="row" align="center">

					                  <input type="hidden" value="<?php echo $row['reservation_id']; ?>" name="reservation_id">

					                   <input type="hidden" value="<?php echo $row['dateto']; ?>" name="to">
					                   	<input type="hidden" value="<?php echo $row['unique_id'] ?>" name="unique">
					                 	<input type="hidden" value="<?php echo $row['datefrom']; ?>" name="from">
					                 	<input type="hidden" value="<?php echo $date; ?>" name = "now">

 										<?php
 											if ($date== $row['datefrom']) {
 										?>
 											<h5>Check-in Date :<?php echo $row['datefrom']; ?></h5>
	                                    	<p class="text-success">Please submit yourself for Inspection. Thank you!</p>
 										<?php
 											}
 											else
 											{
 										?>
 											<h5>Check-in Date:<?php echo $row['datefrom']; ?></h5>
 											

 										<?php
 											}
 										?>


					                  </div>
					                
					                  <div class="modal-footer">
					                  <?php
 											if ($date== $row['datefrom']) {
 										?>
					             			<button type="submit" name="submit_IN" class="btn btn-primary btn-theme">Check-In</button>
					                  <?php } ?>

					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

<!-- OUT -->


					<div class="modal fade" id="out<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/logs.php" align="center">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel" align="center">Information!</h4>
					                  </div>

					                  <div class="row" align="center">

					                  <input type="hidden" value="<?php echo $row['reservation_id']; ?>" name="reservation_id">

					                   <input type="hidden" value="<?php echo $row['dateto']; ?>" name="to">
					                   	<input type="hidden" value="<?php echo $row['unique_id'] ?>" name="unique">
					                 	<input type="hidden" value="<?php echo $row['datefrom']; ?>" name="from">
					                 	<input type="hidden" value="<?php echo $date; ?>" name = "now">

					                 	<?php
 											if ($date <= $row['dateto']) {
 										?>
 											<h5 class="text-danger">Check-Out Date :<?php echo $row['dateto']; ?></h5>
	                                  
 										<?php
 											}
 										?>									

					                  </div>
					                
					                  <div class="modal-footer">
					             		<?php
 											if ($date<= $row['dateto']) {
 										?>
					             			<button type="submit" name="submit_OUT" class="btn btn-primary btn-theme">Check-Out</button>
					                  <?php } ?>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

					        <!--   <div class="modal fade" id="remove<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/cancel.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['reservation_id']?>" name="reservation_id">


					                  	
					                   	Cancel reservation ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div> -->

											
											<?php
											}
											?>
											
										   </tbody>
									    </table>
									</div>


	                            </div>
	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->
	                </div>
	</div>
	</div>
	        
            <?php
           include ("/templates/footer.php");
           ?>
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
	        $('#datatables1').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
		        }
	        });

            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();
	    });
	</script>

</html>
