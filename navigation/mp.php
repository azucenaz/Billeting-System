<ul class="nav">




	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'request' ? 'class="active"':'' ?>>
	                    <a href="request-mp.php">
	                        <i class="fa fa-file"></i>
	                        <p>Requests</p>
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
														
						</ul>
						</div>

	                </li>

	               <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'guestlist' ? 'class="active"':'' ?>>
	                    <a href="guestlist.php">
	                        <i class="fa fa-calendar"></i>
	                        <p>Guest Reservation</p>
	                    </a>
	                </li>

	                <li <?php echo isset($_SESSION['active'])  && $_SESSION['active'] == 'monitor' ? 'class="active"':'' ?>>
	                    <a href="monitoring-mp.php">
	                        <i class="fa fa-users"></i>
	                        <p>Guest Monitoring</p>
	                    </a>
	                </li>



</ul>