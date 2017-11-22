<?php

include 'connection.php';

$fetch = $dbConn->query("SELECT * FROM tbl_transactions where id = '".$_GET['id']."' ");
$row = $fetch->fetch(PDO::FETCH_ASSOC);

$guest = $dbConn->query("SELECT * FROM tbl_guests where guest_id = '".$row['guest_id']."' ");
$display = $guest->fetch(PDO::FETCH_ASSOC);

$ro = $dbConn->query("SELECT * FROM tbl_facilities where facility_id = '".$row['room_id']."' ");
$room = $ro->fetch(PDO::FETCH_ASSOC);

$res = $dbConn->query("SELECT * FROM tbl_reservations where room_id = '".$row['room_id']."'  ");
$reserve = $res->fetch(PDO::FETCH_ASSOC);

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
<body background="assets/img/temp/background.jpg">



<div id="div1">
<br>
<br>
<form>
	<table align="center" width="600px" height="500px">

	<tbody>
	
	<tr>
		<td colspan="4" height="100px"><img src="assets/img/temp/banner.png" width="600px" height="100px"></td>
	</tr>
	<tr>
		<td  colspan="4" height="20px">
			<h4 align="center"><b> - RESERVATION RECEIPT -</b></h4>
		</td>
	</tr>
	<tr>


		<td height="100px">
			<table width="600px" align="center">
				<tr>
					<td align="left" colspan="2" > <i>Guests Information</i></td>
				</tr>
				<tr>
					<td align="right" width="300px"><label><b>Guest Name:</b></label></td>
					<td align="center"><?php echo $display['rank']?> &nbsp;<?php echo $display['guest_name']?>&nbsp;<?php echo $display['BOS']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Serial No:</b></label></td>
					<td align="center"><?php echo $display['serial_no']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Unit Assignment:</b></label></td>
					<td align="center"><?php echo $display['unit']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Address:</b></label></td>
					<td align="center"><?php echo $display['address']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Contact Number</b></label></td>
					<td align="center"><?php echo $display['contact_number']?></td>
				</tr>

			</table>
			
			
		</td>
	</tr>
	<tr>
		<td height="100px">
			<table width="600px" align="center">
				<tr>
					<td align="left" colspan="2"> <i>Reservation Details</i></td>
				</tr>
				<tr>
					<td align="right" width="300px"><label><b>Reservation Type:</b></label></td>
					<td align="center"><?php echo $reserve['type']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Facility Name:</b></label></td>
					<td align="center"><?php echo $room['facility_name']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Room no.:</b></label></td>
					<td align="center"><?php echo $reserve['room_no']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Date Duration</b></label></td>
					<td align="center"><?php echo $reserve['datefrom']?> - <?php echo $reserve['dateto']?></td>
				</tr>


			</table>
			
		</td>
	</tr>
	<tr>
		<td height="100px">
			<table width="600px" align="center">
				<tr>
					<td align="left" colspan="2"> <i>Transaction Details</i></td>
				</tr>
				<tr>
					<td align="right" width="300px"><label><b>Total Payment:</b></label></td>
					<td align="center"><?php echo $row['total_payment']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Amount Render:</b></label></td>
					<td align="center"><?php echo $row['amount_tender']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Change:</b></label></td>
					<td align="center"><?php echo $row['change1']?></td>
				</tr>
				<tr>
					<td align="right"><label><b>Payment Date:</b></label></td>
					<td align="center"><?php echo $row['date_payment']?></td>
				</tr>


			</table>
			
			 <br>
			
		</td>
	</tr>

	<tr>
		<td>
			<h5><b>PASSCODE	:</b> <u><i><?php echo $reserve['unique_id']?></i></u></h5>
		</td>
	</tr>


	<tr>

		<td align="left">
		<b><p class="text-danger">NOTE :Present Receipt upon entering the Base.Do not lose!</p></b>
		
			
	    
		

		</td>
	
	</tr>

		
	</tbody>
	
		
	
</table>

</form>

</div>
<div align="center">
<br>
	<button onclick="printContent('div1')" class="btn btn-wd">PRINT RECEIPT</button>
</div>

</body>

    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

</html>