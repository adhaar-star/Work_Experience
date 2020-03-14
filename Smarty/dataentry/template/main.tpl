
<!DOCTYPE html>
<!-- 
Template Name:Responsive Admin 
Version: 1.1
Author:Tarun Chohan
-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>

	<meta charset="utf-8" />
	<title>Vending Machine Administration</title>
		<link rel="stylesheet" media="print" title="Printer-Friendly" type="text/css" href="template/css/print.css"/>
		<link rel="stylesheet" type="text/css" href="template/css/style.css" media="screen" />
		{$xajaxJavaScript}
		<script language="JavaScript" type="text/javascript" src="template/js/main.js"></script>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/metro.css" rel="stylesheet" />
	<link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<link href="assets/css/style_responsive.css" rel="stylesheet" />
	<link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
	<link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
	<link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="assets/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
	<script type="text/javascript">
		xajax_LoadMenu(); // load the menu on load
	</script>
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<div id="div_header" class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->

				<a class="brand1" href="index.php"><img src="images/logo.png" alt="logo" /></a>
				
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">Menu
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->					
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
<div class="clearfix"></div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
<ul>
<li>
<div class="sidebar-toggler hidden-phone"></div>
</li>
		<li class="active start">
					<a href="index.php">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>					
				</li>	
</ul>		
		<div id="mainMenu" class="active start"></div>
		<div id="sMenu" style="display:none"></div>


			<!-- END SIDEBAR MENU -->
		</div>
	<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
        <div class="page-content">
<div class="container-fluid">
<div id="loadingMessage" style="display:none"><table><tr><td><img src="template/images/loading.gif"></td><td style="font-size:12px;font-weight:bold">Loading...</tr></table></div>
	
	<div id="mainPage">

<h1>Sites & Machines Totals</h1>
<table class="dataTable" cellspacing="0">
<tr><th>Total Active<br>TVR Sites</th>
<th>Total Active<br>MVN Sites</th>
<th>Total Active<br>TVR Machines</th> 
<th>Total Active<br>MVN Machines</th>
<th>TVR Total</th>
<th>MVN Total</th>
<th>Total Active<br>Sites</th>
<th>Total Active<br>Machines</th></tr>
<tr>
<td align="center">{$totals.activeTVRsites}</td>
<td align="center">{$totals.activeMVNsites}</td>
<td align="center">{$totals.activeTVRmachines}</td>
<td align="center">{$totals.activeMVNmachines}</td>
<td align="center">{$totals.totalTVR}</td>
<td align="center">{$totals.totalMVR}</td>
<td align="center">{$totals.activeSites}</td>
<td align="center">{$totals.activeMachines}</td>
</tr>
</table>
	</div>
	</div>
		<!-- END PAGE -->
</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		2015 &copy; Mightyvending.
		
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src="assets/js/jquery-1.8.3.min.js"></script>	
	<!--[if lt IE 9]>
	<script src="assets/js/excanvas.js"></script>
	<script src="assets/js/respond.js"></script>	
	<![endif]-->	
	<script src="assets/breakpoints/breakpoints.js"></script>		
	<script src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>	
	<script src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.blockui.js"></script>	
	<script src="assets/js/jquery.cookie.js"></script>
	<script src="assets/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>	
	<script src="assets/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="assets/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="assets/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="assets/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="assets/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="assets/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>	
	<script src="assets/flot/jquery.flot.js"></script>
	<script src="assets/flot/jquery.flot.resize.js"></script>
	<script type="text/javascript" src="assets/gritter/js/jquery.gritter.js"></script>
	<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>	
	<script type="text/javascript" src="assets/js/jquery.pulsate.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>	
	<script src="assets/js/app.js"></script>				
	
	<!-- END JAVASCRIPTS -->
<script type="text/javascript">
	xajax_LoadMenu(); // call the helloWorld function to populate the div on load
	</script>
</body>
<!-- END BODY -->
</html>

