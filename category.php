<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['user_id'])) 
{
	header("location:logout.php");
}

$_SESSION['active'] = 'category';

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
	            	include 'admin.php';
	            		break;
	            	case 'cashier':
	           		include 'cashier.php';
	            		break;
	            	case 'receptionist':
	            	include 'receptionist.php';
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
							Category
						</a>
	                </div>
	                <?php
	                include 'navbar.php';
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
	            		<div class="col-md-12" style="padding-bottom:10px;">
	            			<button class="btn btn-primary" data-target="#addusers" data-toggle="modal">ADD USERS</button><br>
	            			<div class="modal fade" id="addusers">
					            <div class="modal-dialog ">
					              <div class="modal-content">
					                <form method="post" action="execute/addusers.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Add Users</h4>
					                  </div>
					                  <div class="modal-body">
					                   
					                    <div class="row">
					                      <div class="col-md-6 col-offset-md-6">
					                        <div class="form-group">
					                          <label>Username</label>
					                          <input type="text" class="form-control " name="username" required>
					                        </div>
					                      </div>
					                      
					                    </div>
					                    <div class="row">
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Password</label>
					                          <input type="password" class="form-control " name="password" required>
					                        </div>
					                      </div>
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Re - Password</label>
					                          <input type="password" class="form-control " name="repassword" required>
					                        </div>
					                      </div>
					                    </div>
					                    <div class="form-group">
					                      <label>Account Type</label>
					                      <select class="form-control" name="type" required>
					                        <option value="">Choose</option>
					                        <option value="admin">Administrator</option>
					                        <option value="cashier">Cashier</option>
					                        <option value="receptionist">Receptionist</option>
					                       
					                      </select>
					                    </div>
					                    
					                   
					                    <div class="row">
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Name</label>
					                          <input type="text" class="form-control" name="fullname" required>
					                        </div>
					                      </div>
					                      
					                    </div>
					                   
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Submit</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>
	            		</div>
	            	</div>
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
												<th>Name</th>
												<th>Username</th>
												<th>Type</th>
												<th>Status</th>
												
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										
										<tbody>
											
											<?php
											$users = $dbConn->query("SELECT * FROM tbl_users where username != 'admin'");
											while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
											{
											?>
											<tr>
												<td><?php echo $row['fullname']?></td>
												<td><?php echo $row['username']?></td>
												<td><?php echo $row['type']?></td>
												<td>
												<?php if ($row['status'] == 'active') 
												{
													echo '<span class="label label-success">ACTIVE</span>';
												}
												else
												{
													echo '<span class="label label-success">DISABLE</span>';
												}
												?>
												</td>
												<td>
													<button class="btn btn-success btn-sm" data-target="#<?php echo $row['user_id']?>" data-toggle="modal">
														<i class="fa fa-edit"></i>
													</button>
													<?php 
														if ($row['status'] == 'active') 
														{
															echo '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#times'.$row['user_id'].'">
														<i class="fa fa-times"></i>
													</button>';	
														}
														else
														{
															echo '<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#check'.$row['user_id'].'">
														<i class="fa fa-check"></i>
													</button>	';
														}
													?>
												</td>
											</tr>
							<div class="modal fade" id="times<?php echo $row['user_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/disableusers.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['user_id']?>" name="user_id">
					                   	Disable account ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

					          <div class="modal fade" id="check<?php echo $row['user_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/enableusers.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Warning</h4>
					                  </div>
					                  <div class="modal-body">
					                  	<input type="hidden" value="<?php echo $row['user_id']?>" name="user_id">
					                   	Enable account ?  Yes / No
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
					                    <button type="submit" name="submit" class="btn btn-primary btn-theme">Yes</button>
					                  </div>
					                </form>
					              </div>
					            </div>
					          </div>

											<div class="modal fade" id="<?php echo $row['user_id']?>">
					            <div class="modal-dialog " style="padding-top:60px;">
					              <div class="modal-content">
					                <form method="post" action="execute/updateusers.php">
					                  <div class="modal-header">
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                    <h4 class="modal-title" id="myModalLabel">Update Users</h4>
					                  </div>
					                  <div class="modal-body">
					                   	<input type="hidden" value="<?php echo $row['user_id'];?>" name="user_id">
					                    <div class="row">
					                      <div class="col-md-6 col-offset-md-6">
					                        <div class="form-group">
					                          <label>Username</label>
					                          <input type="text" class="form-control " name="username" required value="<?php echo $row['username']?>">
					                        </div>
					                      </div>
					                      
					                    </div>
					                    <div class="row">
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Password</label>
					                          <input type="password" class="form-control " name="password" required value="<?php echo $row['password']?>">
					                        </div>
					                      </div>
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Re - Password</label>
					                          <input type="password" class="form-control " name="repassword" required value="<?php echo $row['password']?>">
					                        </div>
					                      </div>
					                    </div>
					                    <div class="form-group">
					                      <label>Account Type</label>
					                      <select class="form-control" name="type" required>
					                        <option value="">Choose</option>
					                        <option <?php if($row['type'] == 'admin'){ echo 'selected';}?> value="admin">Administrator</option>
					                        <option <?php if($row['type'] == 'cashier'){ echo 'selected';}?> value="cashier">Cashier</option>
					                        <option <?php if($row['type'] == 'receptionist'){ echo 'selected';}?> value="receptionist">Receptionist</option>
					                       
					                      </select>
					                    </div>
					                    
					                   
					                    <div class="row">
					                      <div class="col-md-6">
					                        <div class="form-group">
					                          <label>Name</label>
					                          <input type="text" class="form-control" name="fullname" required value="<?php echo $row['fullname']?>">
					                        </div>
					                      </div>
					                      
					                    </div>
					                   
					                  </div>
					                  <div class="modal-footer">
					                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					                    <button type="submit" name="submit" class="btn btn-success btn-theme">Update</button>
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
	                </div> <!-- end row -->
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


	<script type="text/javascript">
	    $(document).ready(function() {

	        $('#datatables').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
		        }
	        });
   

	    });
	</script>

</html>
