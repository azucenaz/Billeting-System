<?php
include ("library/connection.php");
session_start();
if (!isset($_SESSION['user_id'])) 
{
    header("location:logout.php");
}

$_SESSION['active'] = 'quarters';

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
                            Quarters
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
                    



                    <div class="row">
                        <div class="col-md-12" style="padding-bottom:10px;">
                            <button class="btn btn-primary" data-target="#addquarters" data-toggle="modal">ADD QUATERS</button><br>
                            <div class="modal fade" id="addquarters">
                                <div class="modal-dialog ">
                                  <div class="modal-content">
                                    <form method="post" action="execute/addquarters.php" enctype="multipart/form-data">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Add Quarters</h4>
                                      </div>
                                      <div class="modal-body">
                                       
                                        <div class="row">

                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                              <label>Upload Picture</label>
                                              <input type="file" class="form-control " name="photo" required>
                                            </div>
                                          </div>                                          
                                          
                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                              <label>Quarters Name</label>
                                              <input type="text" class="form-control " name="name" required>
                                            </div>
                                          </div>


                                       <div class="col-md-8 col-md-offset-2">
                                           <div class="form-group">
                                            <label>Number of rooms</label>
                                            <input type="number" class="form-control"  name="rooms" min="1" required>
                                          </div>
                                        </div>
                                        
                                            <div class="col-md-8 col-md-offset-2">
                                                <label> Status </label>
                                                <select class="form-control" name="status" required>
                                                    <option value="AVAILABLE">Available</option>                                  
                                                    <option value="MAINTENANCE">Maintenance</option>

                                                </select>
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
                                                <th>Picture</th>
                                                <th>Quarters Name</th>
                                                <th>Rooms Number</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                                
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            
                                            <?php
                                            $users = $dbConn->query("SELECT * FROM tbl_quarters");
                                            while ($row = $users->fetch(PDO::FETCH_ASSOC)) 
                                            {
                                            ?>
                                            <tr>

                                                <td><img src="assets/img/<?php echo $row['quarters_image']?>" width="100px" height="100px"></td>                                                
                                                <td><?php echo $row['quarters_name']?></td>
                                                <td>1 - <?php echo $row['room_number']?></td>
                                                <td>
                                                    <?php if ($row['status'] == 'AVAILABLE') 
                                                    {
                                                      echo '<span class="label label-success">AVAILABLE</span>';
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                      <span class="label label-danger"> <?php echo $row['status'] ?> </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                          <button class="btn btn-primary btn-sm update" data-target="#<?php echo $row['quarters_id']?>" data-toggle="modal">
                                                            <i class="fa fa-edit"></i>
                                                          </button>
                                                          <a class="btn btn-success" href="viewreserve.php?id=<?php echo $row['quarters_id']?>" target="_blank">VIEW</a>
                                                  </td>
                                               

                                            </tr>


                          <div class="modal fade" id="<?php echo $row['quarters_id']?>">
                                <div class="modal-dialog ">
                                  <div class="modal-content">
                                    <form method="post" action="">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Update Quarters</h4>
                                      </div>
                                      <div class="modal-body">
                                       
                       
                                      <div class="row">

                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                              <label>Upload Picture</label>
                                              <input type="file" class="form-control " name="photo" required>
                                            </div>
                                          </div>                                          
                                          
                                          <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                              <label>Quarters Name</label>
                                              <input type="text" class="form-control " name="name" required>
                                            </div>
                                          </div>


                                       <div class="col-md-8 col-md-offset-2">
                                           <div class="form-group">
                                            <label>Number of rooms</label>
                                            <input type="number" class="form-control"  name="rooms" min="1" required>
                                          </div>
                                        </div>
                                        
                                            <div class="col-md-8 col-md-offset-2">
                                                <label> Status </label>
                                                <select class="form-control" name="status" required>
                                                    <option value="AVAILABLE">Available</option>
                                                    <option value="MAINTENANCE">Maintenance</option>

                                                </select>
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

            $("#avail1").hide();
            $(".selectroom").click( function()
            {
                var facility_name = $(this).data("facilityname");
                var facility_id = $(this).data("facilityid");
                var rooms_count = $(this).data("numberrooms");


                $("#facility_name1").val(facility_name);
                $("#facility_id").val(facility_id);
                $("#avail1").show();
                $("#hidethis").hide();
                $("#room_no").attr('max',rooms_count);
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
