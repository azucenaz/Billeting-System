<?php
include ("./library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = 'request';

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
							Requests List
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
												<th>Guest ID</th>
												<th>Source</th>
												<th>Guest Name</th>
												<th>From - To </th>
												<th>Request Type</th>
												<th>Request No.</th>
												
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										
										<tbody align="left">
											
											<?php
											$users = $dbConn->query("SELECT * FROM tbl_reservations where status = 'PENDING' ");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
												
											?>
											<tr data-toggle="modal" data-target="#">

												<td>
													<?php $getid = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$disID = $getid->fetch(PDO::FETCH_ASSOC);
													echo $disID['guest_id'];
													?>
												</td>

												<td>
													<?php $getname1 = $dbConn->query("SELECT * FROM tbl_users where user_id = '".$row['user_id']."' ");
													$dis1 = $getname1->fetch(PDO::FETCH_ASSOC);
													echo $dis1['fullname'];
													?>

												</td>


												<td>
													<h6>
													<?php $getname = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$dis = $getname->fetch(PDO::FETCH_ASSOC);
													echo $dis['rank'];
													?>&nbsp;
													<?php
													echo $dis['guest_name']
													?>
													&nbsp;
													<?php
													echo $dis['serial_no']
													?>
													&nbsp;
													<?php
													echo $dis['BOS']
													?>
													</h6>
												</td>



												<td><?php echo $row['datefrom']?> - <?php echo $row['dateto'] ?></td>

												<td>
													<?php
														if ($row['type'] == 'Ameneties') {
															$getname = $dbConn->query("SELECT * FROM tbl_ameneties where ameneties_id = '".$row['room_id']."' ");
															$dis = $getname->fetch(PDO::FETCH_ASSOC);
															echo $dis['ameneties_name'];
														}else{
															echo ucfirst($row['type']);
														}
													?>
													
												</td>


													<td align="center">
														<?php echo ($row['reservation_id']);?>
													</td>


												<td>
													<button class="btn btn-danger btn-sm update" data-target="#remove<?php echo $row['reservation_id']?>" data-toggle="modal">
														<i class="fa fa-times"></i>
													</button>
													
													<?php
													if ($row['type'] == 'Ameneties') {
														#
													?>
													<button class="btn btn-success btn-sm update" data-target="#am<?php echo $row['reservation_id']?>" data-toggle="modal">
														PROCESS
													</button>

													<?php
												}else{
												?>


													<button class="btn btn-success btn-sm update" data-target="#<?php echo $row['reservation_id']?>" data-toggle="modal">
														PROCESS
													</button>
													<?php } ?>

												</td>
											</tr>

							<div class="modal fade" id="<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/passed.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Create Room Assignment ?</h4>
					                  </div>
					                 <input type="hidden" value="<?php echo $row['reservation_id']; ?>" name="reservation_id">

					                 <input type="hidden" value="<?php echo $dis['guest_name']; ?>" name="guest_name">
					                 <input type="hidden" value="<?php echo $dis['serial_no']; ?>" name="serial_number">
					                 <input type="hidden" value="<?php echo $dis['rank']; ?>" name="rank">
					                 <input type="hidden" value="<?php echo $dis['BOS']; ?>" name="BOS">
					                 
					                 <input type="hidden" value="<?php echo $row['datefrom']; ?>" name="from">
									<input type="hidden" value="<?php echo $row['dateto']; ?>" name="to">
									<input type="hidden" value="<?php echo $row['room_id']; ?>" name="room_id">

					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">YES</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

					          <div class="modal fade" id="am<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/check_am.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Approved  ?</h4>
					                  </div>
					                 <input type="hidden" value="<?php echo $row['reservation_id']; ?>" name="reservation_id">

					                 <input type="hidden" value="<?php echo $dis['guest_name']; ?>" name="guest_name">
					                 <input type="hidden" value="<?php echo $row['datefrom']; ?>" name="from">
									<input type="hidden" value="<?php echo $row['dateto']; ?>" name="to">
									<input type="hidden" value="<?php echo $row['room_id']; ?>" name="room_id">


					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">YES</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>



					          <div class="modal fade" id="remove<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/cancel.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Cancel reservation?</h4>
					                  </div>
					                  <!-- <div class="modal-body"> -->
					                  	<input type="hidden" value="<?php echo $row['reservation_id']?>" name="reservation_id">	
					                  	<input type="hidden" value="<?php echo $row['unique_id']?>" name="unique_id">

					                 <!--  </div> -->
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
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
	                </div>
				                        </div>


			
											
										

	                <!-- end row -->
	         
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
