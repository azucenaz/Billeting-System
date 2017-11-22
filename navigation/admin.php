-<ul class="nav">



					<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'dashboard' ? 'class="active"':'' ?>>
	                    <a href="index.php">
	                        <i class="fa fa-dashboard"></i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>

	                <li >
	                    <a data-toggle="collapse" href="#dashboardOverview1" aria-expanded="true">
	                        <i class="fa fa-list"></i>
	                        <p>List
                                <b class="caret"></b>
                            </p>
	                    </a>
	                        <div class="collapse" id="dashboardOverview1">
							<ul class="nav">
								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'request' ? 'class="active"':'' ?>>
									<a href='reservations.php'>Request List</a>
								</li>

				                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'billeting' ? 'class="active"':'' ?>>
				                    <a href="billeting.php">Billeting List</a>				                                
				                </li>

								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'approve' ? 'class="active"':'' ?>>
									<a href="approve.php">Approved List</a>
								</li>
								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'history' ? 'class="active"':'' ?>>
									<a href="history.php"> History List </a>
								</li>
							
							</ul>
	                 </li>


								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'process_reservation_Facilities' ? 'class="active"':'' ?>>								
									<a href="process_reservation_Facilities.php">
									 <i class="fa fa-car"></i>
									<p>Facilities Reservation</p>
									</a>
								</li>


	                <li >
	                    <a data-toggle="collapse" href="#facilities" aria-expanded="true">
	                        <i class="fa fa-home"></i>
	                        <p>Facilities
	                        <b class="caret"></b>
	                        </p>
	                    </a>


	                    <div class="collapse" id="facilities">
	                    <ul class="nav">
	                    		<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'facilities' ? 'class="active"':'' ?>>
									<a href="facilities.php">Accomodation Facility</a>
								</li>

								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'ameneties' ? 'class="active"':'' ?>>
									<a href="ameneties.php">Base Ameneties</a>
								</li>

								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'quarters' ? 'class="active"':'' ?>>
									<a href="quarters.php">Quarters</a>
								</li>


								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'barracks' ? 'class="active"':'' ?>>
									<a href="barracks.php">Barracks</a>
								</li>
								
							
							
						</ul>
						</div>

	                </li>




	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'guest' ? 'class="active"':'' ?>>
	                    <a href="guest.php">
	                        <i class="fa fa-user"></i>
	                        <p>Guests</p>
	                    </a>
	                </li>
	                
	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'transactions' ? 'class="active"':'' ?>>
	                    <a href="transactions.php">
	                        <i class="fa fa-table"></i>
	                        <p>Transactions</p>
	                    </a>
	                </li>


	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'users' ? 'class="active"':'' ?>>
	                    <a href="users.php">
	                        <i class="fa fa-users"></i>
	                        <p>Users</p>
	                    </a>
	                </li>


	            </ul>