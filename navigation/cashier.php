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

								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'approve' ? 'class="active"':'' ?>>
									<a href="approve.php">Approved List</a>
								</li>
								<li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'history' ? 'class="active"':'' ?>>
									<a href="history.php"> History List </a>
								</li>
							
							</ul>
	                 </li>




	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'transactions' ? 'class="active"':'' ?>>
	                    <a href="transactions.php">
	                        <i class="fa fa-table"></i>
	                        <p>Transactions</p>
	                    </a>
	                </li>


	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'guest' ? 'class="active"':'' ?>>
	                    <a href="guest.php">
	                        <i class="fa fa-user"></i>
	                        <p>Guest Lists</p>
	                    </a>
	                </li>


</ul>