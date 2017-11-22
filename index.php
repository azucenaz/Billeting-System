<?php
include ("library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}
$_SESSION['active'] = 'dashboard';
?>



<?php include("templates/header.php") ?>

<?php
	$year = date("Y");
	$month = date("m");
	$today = date("Y-m-d");
	 $total = $dbConn->query("SELECT sum(total_payment) FROM tbl_transactions where year(date_payment) = '".$year."' ");
	                                           $dis = $total->fetch(PDO::FETCH_ASSOC);
	                                          $yeardisplay = $dis['sum(total_payment)'];
	$total1 = $dbConn->query("SELECT sum(total_payment) FROM tbl_transactions where month(date_payment) = '".$month."' ");
	                                           $dis1 = $total1->fetch(PDO::FETCH_ASSOC);
	                                          $monthdisplay = $dis1['sum(total_payment)'];
	$total2 = $dbConn->query("SELECT sum(total_payment) FROM tbl_transactions where month(date_payment) = '".$today."' ");
	                                           $dis2 = $total2->fetch(PDO::FETCH_ASSOC);
	                                          $todaydisplay = $dis2['sum(total_payment)'];

?>

<input type="hidden" value="<?php echo $yeardisplay;?>" id="year">
<input type="hidden" value="<?php echo $monthdisplay;?>" id="month">
<input type="hidden" value="<?php echo $todaydisplay;?>" id="today">
 
 
 
<script type="text/javascript">
		
		window.onload = function () {
			var	year = $("#year").val();

			var	month = $("#month").val();

			var	today = $("#today").val();
			var chart = new CanvasJS.Chart("chartContainer",
			{
				title: {
					text: " Total Income "
				},
				axisY: {
					stripLines: [{
						value: 143650,
						label: "Average",
						showOnTop: true
					}
					]
				},

				data: [
				{
					type: "bar",

					dataPoints: [
						{ x: 10, y: parseInt(year), label: "Yearly Sales" },
						{ x: 20, y: parseInt(month), label: "Monthly Sales" },
						{ x: 30, y: parseInt(today), label: "Today Sales" }
					]
				}
				]
			});

			chart.render();
		}
	</script>
	<script src="canvasjs.min.js"></script>

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
	            	// case 'mp':
	            	// include ("navigation/mp.php");
	            	// 	break;
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
							Dashboard
						</a>
	                </div>


	                <?php
	                  include ("includes/navbar.php");
	                ?>
	                
	            </div>
	        </nav>

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">





	                	<div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="content">
	                                <div class="row">
	                                    <div class="col-xs-3">
	                                        <div class="icon-big icon-success text-center">
	                                            <i class="fa fa-money"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-9">
	                                        <div class="numbers">
	                                            <p>Total Income</p>
	                                          <?php
	                                          $total = $dbConn->query("SELECT sum(total_payment) FROM tbl_transactions");
	                                           $dis = $total->fetch(PDO::FETCH_ASSOC);
	                                           echo number_format($dis['sum(total_payment)'],2);
	                                          ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="card-footer">
									<hr />
									
								</div>
	                        </div>
	                    </div>
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center">
	                                            <i class="fa fa-users"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>Guests</p>
	                                            <?php 
	                                            $guest = $dbConn->query("SELECT * FROM tbl_guests");
	                                            echo $guest->rowCount();

	                                            ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="card-footer">
									<hr />
									
								</div>
	                        </div>
	                    </div>
	                    
	                  <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center">
	                                            <i class="fa fa-flag"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>Base Ameneties</p>
	                                            <?php 
	                                            $guest = $dbConn->query("SELECT * FROM tbl_ameneties");
	                                            echo $guest->rowCount();

	                                            ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="card-footer">
									<hr />
									
								</div>
	                        </div>
	                    </div>


	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="content">
	                                <div class="row">
	                                    <div class="col-xs-2">
	                                        <div class="icon-big icon-danger text-center">
	                                            <i class="fa fa-hotel"></i>
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-10">
	                                        <div class="numbers">
	                                            <p>Accomodation Facility</p>
	                                            <?php 
	                                            $fac = $dbConn->query("SELECT * FROM tbl_facilities");
	                                            echo $fac->rowCount();
	                                            ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
								<div class="card-footer">
									<hr />
									
								</div>
	                        </div>
	                    </div>
	               
	                </div>





					<div class="row">
						
						<div class="col-lg-12 col-sm-12">
							<div class="card">
								<div class="content">
									<div class="row">
										<div class="col-xs-7">
											<div class="numbers pull-left">
												Chart
											</div>
										</div>
										<div class="col-xs-5">
											
										</div>
									</div>
									
		                            <div id="chartContainer" style="height: 400px; width: 100%;">
	</div>
								</div>
								
							</div>
						</div>
						
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



	

</html>
