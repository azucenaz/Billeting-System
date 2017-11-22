<?php
include ("./library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = 'ameneties-mp';

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
							Base Ameneties
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
	            	
	            	


	            	<!-- <div class="row">
	            		<div class="col-md-12" style="padding-bottom:10px;">
	            			<!-- <button class="btn btn-primary" data-target="#addameneties" data-toggle="modal">NEW AMENETY</button><br> -->
	            			
	            			<div class="modal fade" id="addameneties">
					            <div class="modal-dialog ">
					              <div class="modal-content">


					             <form method="post" action="execute/.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">New Amenety</h4>
					                  </div>
					                  <div class="modal-body">



					                   <div class="row">
					                  	<center>
					                  			<img src="<?php echo $row['']; ?>" width="250px" height="150px">
					                  	</center>


				                 
					                  	<div class="col-md-8 col-md-offset-2">
					                  		<label>Name</label>
	                                         <input type="text" placeholder="" class="form-control" name="facility_name" required>
	                                    </div>

	                                   	<div class="col-md-8 col-md-offset-2">
											<label>Description</label>
	                                         <textarea class="form-control" placeholder="" rows="3" name="desc" required></textarea>
	                                    </div>

					                  	<div class="col-md-8 col-md-offset-2">
											<label>Capacity</label>
	                                         <input type="text" placeholder="" class="form-control" name="capacity" required>
	                                    </div>

				                

					                  </div>
	
					                  </div>

					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Add</button>
					                  </div>
					              </form>



					              </div>
					            </div>
					          </div>



	            		</div>
	            	<!-- </div> -->



	                                	


<!-- Modal Button -->
<div class = "col-md-4 col-md-offset-1">
	<div class="col-md-12">
	             <div class="card">
	                 <div class="content text-center">


	                 <!-- picture of Facility-->
	                 <img src="---">
					                  			
	                <h5>CG's Quarters</h5>
	                   
	               	<div class="row">
	            		<div class="col-md-12" style="padding-bottom:10px;">

	            			<button class="btn btn-primary" data-target="#requestroom" data-toggle="modal">View</button><br>		

	            		</div>
	            	</div>

							

	        </div>
	        </div>
	  </div>
</div>	<!-- ------------------------- -->



<!-- Modals-->


	            			<div class="modal fade" id="requestroom">
					            <div class="modal-dialog ">
					              <div class="modal-content">



					                <form method="post" action="execute/.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">CG's Quarters</h4>
					                  </div>
					                  <div class="modal-body">
					                   
					                   
					             <div class="row">
					             		<center>
					             				   <!-- picture of Facility-->
	                 							<img src="---" width="20px">
	                 							<div class="col-md-12" style="padding-bottom:10px;">
	                 								<h6>CG's Quarters</h6>
	                 								<p>Description</p>
	                 							</div>
	                 							


					             		</center>			            
					             </div> 
				                        
					                   
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                    <button type="submit" name="request" class="btn btn-success btn-theme">Submit</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>


<!-- ------------------ -->









								








	          <!--  </div> -->
	           </div>
	        </div> <!-- end row -->
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

		<!-- Sweet Alert 2 plugin -->
	<script src="assets/js/sweetalert2.js"></script>

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

            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();
	    });
	</script>

</html>
