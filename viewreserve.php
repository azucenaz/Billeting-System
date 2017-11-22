<?php
include ("./library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = '';

?>
<?php include("templates/header.php") ?> 

<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>





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
						<?php 

												$getroom = $dbConn->query("SELECT * FROM tbl_facilities where facility_id = '".$_GET['id']."' ");
												$disroom = $getroom->fetch(PDO::FETCH_ASSOC);

												 echo $disroom['facility_name'];

						?>	

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

	            	<button onclick="printContent('occupants')" class="btn btn-info">ACCOMODATION REPORT</button>
				    <br>
				    <br>


				    

				    <div class="row">
	                    <div class="col-md-12">
							
	                        <div class="card">
	                            <div class="content">
	                                <div class="toolbar">
	                                   
	                                </div>

	                                

                                    <div class="fresh-datatables">


                                    	<div id="occupants">  <!-- start of print -->
                                    
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										
										<thead>
									<div align="center">
										<h3><b><?php echo $disroom['facility_name']; ?></b></h3>
									</div>
										
											<tr>
												<th>Guest Name</th>
												<th>Room No.</th>
												<th>From</th>
												<th>To</th>	
												<th>Unit</th>										
												<th>Status</th>
												
												<!-- <th class="disabled-sorting">Actions</th> -->
											</tr>
										</thead>
										
										<tbody>
											
											<?php
											$users = $dbConn->query("SELECT * FROM tbl_reservations where room_id = '".$_GET['id']."' ");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
												
											?>
											<tr data-toggle="modal" data-target="#">
												<td>
													<?php $getname = $dbConn->query("SELECT * FROM tbl_guests where unique_id = '".$row['unique_id']."' ");
													$dis = $getname->fetch(PDO::FETCH_ASSOC);
													?>
													<?php echo $dis['rank']; ?> <?php echo $dis['guest_name']; ?> <?php echo $dis['BOS']; ?>
												</td>

												<td>
													Room No. <?php echo ($row['room_no'])?>
												</td>

												<td>
													<label font-style="bold"> <?php echo $row['datefrom']?></label>
												</td>
												
												<td>
													<label font-style="bold"><?php echo $row['dateto'] ?></label>
												</td>

												<td>
													<?php echo ($dis['unit']) ?>
												</td>
												
												<td align="left">
													<?php if ($dis['status'] == 'PENDING') {
														echo "RESERVED";
													} elseif ($dis['status'] == 'IN') {
													 	echo "IN";
													 } else { echo "OUT";} ?>
												</td>
												


												
											</tr>
											</div>   <!-- end print  -->
											
							
					          <div class="modal fade" id="view<?php echo $row['reservation_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Reservation Details</h4>
					                  </div>
					                  <div class="modal-body">
					                  	Guest Name: <?php echo $dis['guest_name'];?><br>
					                  	Facility Name: <?php echo $disroom['facility_name']?><br>
					                  	Room Number: <?php echo $row['room_no']?><br>
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                   
					                  </div>
					                
					              </div>
					            </div>
					          </div>
								
											<?php
											}
											?>
											
										   </tbody>

									    </table>
									</div>


	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->

				</div>
				                       
				</div><!-- end row -->


	            	
	               
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
            demo.initFormExtendedDatetimepickers();
	    });
	</script>

</html>
