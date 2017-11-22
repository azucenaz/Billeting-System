<div class="collapse navbar-collapse">


	                    <ul class="nav navbar-nav navbar-right">
	                        
	                    <?php 
	                    	if ($_SESSION['type'] == 'admin') {
	                    		
	                   	?>
	                        <li>
	                            <a href="reservations.php">
	                                <i class="fa fa-bell"></i>
									<p>
									
									<?php 
									include 'connection.php';
									$check = $dbConn->query("SELECT * FROM tbl_reservations where status = 'pending' ");
									$count = $check->rowCount();
									echo "(".$count.")";
										?>
									</p>
	                            </a>
	                        </li>
	                     <?php
	                     }?>
	                        <li class="dropdown">
	                            <a href="#notifications" class="dropdown-toggle btn-rotate" data-toggle="dropdown">
	                                <i class="ti-bell"></i>
	                                <span class="notification"><?php echo $_SESSION['fullname'];?></span>
									
	                            </a>
	                            <ul class="dropdown-menu">
	                                <li><a href="logout.php">Log out</a></li>
	                                
	                            </ul>
	                        </li>
							<li>
	                            <a href="#settings" class="btn-rotate">
									<i class="ti-settings"></i>
									<p class="hidden-md hidden-lg">
										Settings
									</p>
	                            </a>
	                        </li>
	                    </ul>
	                </div>