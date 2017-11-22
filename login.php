<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title></title>

	<!-- Canonical SEO -->
    

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    
</head>

<body>
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


               <!--  <a class="navbar-brand" align = "center">BASE BILLETING SYSTEM</a> -->
               
            </div>

                <div class="col-md-12">
                   <h2 align="center"><font  face="Bodoni MT Black" color="99FFFF">BASE BILLETING SYSTEM</font></h2>
                    <hr width="50%" size="3" noshade />
               </div>


        </div>
    </nav>

          
<!-- background:url(assets/img/paf.png); -->
    <div class="wrapper wrapper-full-page" style="background:url(assets/img/paf.png);">
        <div class="full-page login-page" data-color="" data-image="assets/img/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        
              

            <div class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

                                        <?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '';
                                        unset($_SESSION['message']);
                                        ?>
                            <form method="post" action="execute/login.php">
                                <div class="card" data-background="color" data-color="blue">

                                    <div class="content">
                 
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" placeholder="Enter Username" class="form-control input-no-border" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" class="form-control input-no-border" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success btn-lg btn-block" value="LOGIN" name="submit">
                                        </div>
                                       
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        	
        </div>
    </div>
</body>

	<!--   Core JS Files. Extra: PerfectScrollbar + TouchPunch libraries inside jquery-ui.min.js   -->
	<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	

</html>
