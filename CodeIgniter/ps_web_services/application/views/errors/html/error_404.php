<?php $base_url = config_item('base_url');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Help YA CMS</title>
		<!-- Bootstrap -->
        <link href="<?php echo $base_url.'assets'; ?>/images/meta_icons/favicon.ico" rel='shortcut icon' type='image/x-icon'>
		<link href="<?php echo $base_url.'assets'; ?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $base_url.'assets'; ?>/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo $base_url.'assets'; ?>/css/style.css" rel="stylesheet">
    	<script src="<?php echo $base_url.'assets'; ?>/javascripts/jquery/jquery.min.js" type="text/javascript"></script>

		<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
			<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
			<![endif]-->
		</head>
		<body>
			
			<div class="main-body_content">
				<div class="container">
					<div class="content_bg bor-bottom">
						<div class="row">
							<div class="col-sm-8 col-sm-offset-2">
								<div class="four_not_four_sec">
									<div class="logo">
										<img src="<?php echo $base_url.'assets'; ?>/images/logo.png" alt="">
									</div>
									<h1 class="jquery_blink">404</h1>
									<script type="text/javascript">
										setInterval(blinker, 1000);
										function blinker() {
										  $('.jquery_blink').fadeOut(500);
										  $('.jquery_blink').fadeIn(500);
										}
									</script>
									<p><i class="fa fa-info-circle"></i> Oops! The page you requested was not found!</p>
									<span>You can go to <a href="<?php echo $base_url; ?>home">Home</a> page</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>