<?php
include ("library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
header("location:logout.php");
}
$_SESSION['active'] = 'facilities';
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
                    <a class="navbar-brand" href="#"> Base Facilities</a>
                </div>
                <?php
               include ("includes/navbar.php");
                ?>
            </div>
        </nav>
            <div class="content">
            <div class="container-fluid">


            <?php
            if($_SESSION['type'] == 'admin'): 
            echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
            unset($_SESSION['message']);
            endif;
            ?>
            
            
            <div class="row">
            <div class="col-md-12" style="padding-bottom:10px;">

        <?php if($_SESSION['type'] == 'admin'): ?>
            <button class="btn btn-primary" data-target="#addfacility" data-toggle="modal">NEW FACILITY</button><br>
        <?php endif; ?>

            <div class="modal fade" id="addfacility">
            <div class="modal-dialog ">
              <div class="modal-content">
             <form method="post" action="execute/addfacility.php" enctype="multipart/form-data">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Facility</h4>
                  </div>
                  <div class="modal-body">
                   <div class="row">
                  
                            <div class="col-md-8 col-md-offset-2">
                                <label>Upload Picture</label>
                                    <input type="file" placeholder="" class="form-control" name="photo" required>
                            </div>
                 
                            <div class="col-md-8 col-md-offset-2">
                                <label>Name</label>
                                    <input type="text" placeholder="" class="form-control" name="name" required>
                            </div>

                            <div class="col-md-8 col-md-offset-2">
                                <label>Description</label>
                                    <textarea class="form-control" placeholder="" rows="3" name="description" required></textarea>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <label>Capacity</label>
                                    <input type="number" min="0" placeholder="" class="form-control" name="capacity" required>
                            </div>

                            <div class="col-md-8 col-md-offset-2">
                                <label>Price Per Night</label>
                                <input type="number" min="0" step="0.01" placeholder="" class="form-control" name="price" required>
                            </div>

                             <div class="col-md-8 col-md-offset-2">
                                <label>Number of rooms</label>
                                <input type="number" min="1"  placeholder="" class="form-control" name="room_no" required>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <label>RANK</label><BR>
                                <input type="checkbox" value="1" name="am"> AM
                                <input type="checkbox" value="1" name="a2c"> A2C
                                <input type="checkbox" value="1" name="a1c"> A1C
                                <input type="checkbox" value="1" name="sgt"> SGT
                                <input type="checkbox" value="1" name="ssgt"> SSGT
                                <input type="checkbox" value="1" name="tsgt"> TSGT
                                <input type="checkbox" value="1" name="msgt"> MSGT
                                <input type="checkbox" value="1" name="cmsgt"> CMSGT
                                <input type="checkbox" value="1" name="2lt"> 2LT
                                <input type="checkbox" value="1" name="1lt"> 1LT
                                <input type="checkbox" value="1" name="cpt"> CPT
                                <input type="checkbox" value="1" name="maj"> MAJ
                                <input type="checkbox" value="1" name="ltcol"> LTCOL
                                <input type="checkbox" value="1" name="col"> COL
                                <input type="checkbox" value="1" name="bgen"> BGEN
                                <input type="checkbox" value="1" name="mgen"> MGEN
                                <input type="checkbox" value="1" name="ltgen"> LTGEN
                                <input type="checkbox" value="1" name="gen"> GEN
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
            </div>
            


            
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div class="toolbar">
                                   
                                <div class="row">
                           
                                <?php

                                $get = $dbConn->query("SELECT * FROM tbl_facilities");
                                while($row = $get->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>

                                
        <div class="col-md-3">
            <div class="card">
                <div class="content text-center">
                    <img src="assets/img/<?php echo $row['facility_image']; ?>" style="width:200px;height:200px;" >
                    <h5><?php echo $row['facility_name']; ?></h5>
                    <div class="row">
                        <div class="col-lg-12" style="padding-bottom:10px;">
                <?php if($_SESSION['type'] == 'admin'){ ?>
                        <button class="btn btn-info" data-target="#<?php echo $row['facility_id']; ?>" data-toggle="modal">EDIT</button>
                        <a class="btn btn-success" href="viewreserve.php?id=<?php echo $row['facility_id']?>" target="_blank">VIEW</a>
                  <?php }else{  ?>                
                        <button class="btn btn-info" data-target="#view_details<?php echo $row['facility_id']?>" data-toggle="modal">VIEW</button>
                  <?php }; ?>                                      
                                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>

                         <div class="modal fade" id="view_details<?php echo $row['facility_id']?>">
                                <div class="modal-dialog " style="padding-top:60px;">
                                  <div class="modal-content">
                                    
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Facility Details</h4>
                                      </div>
                                      <div class="modal-body">
                                        Facility Name: <?php echo $row['facility_name'];?><br>
                                 
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                       
                                      </div>
                                    
                                  </div>
                                </div>
                              </div>







            <div class="modal fade" id="<?php echo $row['facility_id']; ?>" style="margin-top:100px;">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <form method="post" action="execute/updatefacility.php">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h5 class="modal-title" id="myModalLabel" align="center">Update Facility</h5>
                                            </div>

                                            <div class="modal-body">
                                            <div class="row">

                                                <input type="hidden" value="<?php echo $row['facility_id'];?>" name="id">


                                                <div class="col-md-8 col-md-offset-2">
                                                    <label>Upload Picture</label>
                                                        <input type="file" placeholder="" class="form-control" name="photo" required >
                                                </div>
                                     
                                                <div class="col-md-8 col-md-offset-2">
                                                    <label>Name</label>
                                                        <input type="text" placeholder="" class="form-control" name="name" required value="<?php echo $row['facility_name']?>">
                                                </div>

                                                <div class="col-md-8 col-md-offset-2">
                                                    <label>Description</label>
                                                        <textarea class="form-control" name="description" required ><?php echo $row['facility_description']?></textarea>
                                                </div>
                                                <div class="col-md-8 col-md-offset-2">
                                                    <label>Capacity</label>
                                                        <input type="number" min="0" placeholder="" class="form-control" name="capacity" required value="<?php echo $row['facility_capacity']?>">
                                                </div>

                                                         <div class="col-md-8 col-md-offset-2">
                                                    <label>Price</label>
                                                        <input type="number" min="0" step="0.01" placeholder="" class="form-control" name="price" required value="<?php echo $row['facility_price']?>">
                                                </div>

                                                <div class="col-md-8 col-md-offset-2">
                                                            <label>Number of rooms</label>
                                                            <input type="number" min="1"  placeholder="" class="form-control" name="room_no" required value="<?php echo $row['rooms_count']?>">
                                                        </div>                                               


                                            <div class="col-md-8 col-md-offset-2">
                                                <label> Status </label>
                                                <select class="form-control" name="status" required>
                                                    <option value="Available">Available</option>
                                                    <option value="Fully Booked">Fully Booked</option>
                                                    <option value="Maintenance">Maintenance</option>

                                                </select>
                                             </div>
                                             <?php 
                                             $lami = $dbConn->query("SELECT * FROM tbl_rank_allowed where facilties_id = '".$row['facility_id']."' ");
                                             $rank = $lami->fetch(PDO::FETCH_ASSOC);
                                             ?>
                                              <div class="col-md-8 col-md-offset-2">
                                <label>RANK</label><BR>
                                <input type="checkbox" value="1" name="am" <?php if($rank['AM'] == '1'){ echo 'checked';}?> > AM
                                <input type="checkbox" value="1" name="a2c" <?php if($rank['A2C'] == '1'){ echo 'checked';}?> > A2C
                                <input type="checkbox" value="1" name="a1c" <?php if($rank['A1C'] == '1'){ echo 'checked';}?> > A1C
                                <input type="checkbox" value="1" name="sgt" <?php if($rank['SGT'] == '1'){ echo 'checked';}?> > SGT
                                <input type="checkbox" value="1" name="ssgt" <?php if($rank['SSGT'] == '1'){ echo 'checked';}?> > SSGT
                                <input type="checkbox" value="1" name="tsgt" <?php if($rank['TSGT'] == '1'){ echo 'checked';}?> > TSGT
                                <input type="checkbox" value="1" name="msgt" <?php if($rank['MSGT'] == '1'){ echo 'checked';}?> > MSGT
                                <input type="checkbox" value="1" name="cmsgt" <?php if($rank['CMSGT'] == '1'){ echo 'checked';}?> > CMSGT
                                <input type="checkbox" value="1" name="2lt" <?php if($rank['2LT'] == '1'){ echo 'checked';}?> > 2LT
                                <input type="checkbox" value="1" name="1lt" <?php if($rank['1LT'] == '1'){ echo 'checked';}?> > 1LT
                                <input type="checkbox" value="1" name="cpt" <?php if($rank['CPT'] == '1'){ echo 'checked';}?> > CPT
                                <input type="checkbox" value="1" name="maj" <?php if($rank['MAJ'] == '1'){ echo 'checked';}?> > MAJ
                                <input type="checkbox" value="1" name="ltcol" <?php if($rank['LTCOL'] == '1'){ echo 'checked';}?> > LTCOL
                                <input type="checkbox" value="1" name="col" <?php if($rank['COL'] == '1'){ echo 'checked';}?> > COL
                                <input type="checkbox" value="1" name="bgen" <?php if($rank['BGEN'] == '1'){ echo 'checked';}?> > BGEN
                                <input type="checkbox" value="1" name="mgen" <?php if($rank['MGEN'] == '1'){ echo 'checked';}?> > MGEN
                                <input type="checkbox" value="1" name="ltgen" <?php if($rank['LTGEN'] == '1'){ echo 'checked';}?> > LTGEN
                                <input type="checkbox" value="1" name="gen" <?php if($rank['GEN'] == '1'){ echo 'checked';}?> > GEN
                            </div>


<!--                                             <div class="col-md-8 col-md-offset-2">

                                                
                                            <p>
                                                    <b>Name: </b>
                                                    <?php echo $row['facility_name']; ?><br>
                                                    <b>Description: </b><?php echo $row['facility_description']; ?><br>
                                                    <b>Price: </b><?php echo $row['facility_price']; ?><br>
                                            </p>
                                            </div> -->

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



                                <div class="modal fade" id="reserve<?php echo $row['facility_id']; ?>" style="margin-top:100px;">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        
                                            <div class="modal-header">
                                            <form method="post" action="execute/payment1.php">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Reserved</h4>
                                            </div>
                                            <div class="modal-body clearfix">
                                                <input type="hidden" value="<?php echo $row['ameneties_id']; ?>" name="room_id">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        From 
                                                <input type="text" id="from" name="from" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        To
                                                <input type="text" id="to" name="to" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    <div class="col-md-6">
                                                    Guest Name
                                                        <input type="text" class="form-control" name="guest_name" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                    Unit
                                                        <input type="text" class="form-control" name="unit" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <div class="col-md-6">
                                                    Contact Number
                                                        <input type="text" class="form-control" name="contact_number" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                    Address
                                                        <input type="text" class="form-control" name="address" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="submit">RESERVE</button>
                                            
                                            </form>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div><!-- col-md-3 -->
        <?php
    }
        ?>
                <!-- <div class="col-md-3">
                                <div class="card">
                                    <div class="content text-center">
                                        <h5>A title with a text under</h5>
                                        <button class="btn btn-default btn-fill" onclick="demo.showSwal('input-field')">Try me!</button>
                                    </div>
                                </div>
                            </div>
 -->
</div>
                                </div>
                            </div>
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->              
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

        $('#from,#to').datetimepicker({format: 'YYYY-MM-DD',
            minDate : new Date(),    //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'}});
    });
</script>
</html>
