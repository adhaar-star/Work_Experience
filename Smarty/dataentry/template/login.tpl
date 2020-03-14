<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<!--<link rel="stylesheet" type="text/css" href="template/css/style.css"/>
		{$xajaxJavaScript}
		<script language="JavaScript" type="text/javascript" src="template/js/main.js"></script>-->
  <meta charset="utf-8" />
  <title>Vending Machine Administration</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/metro.css" rel="stylesheet" />
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/style_responsive.css" rel="stylesheet" />
  <link href="assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <img src="images/logo.gif" alt="" /> 
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="form-vertical login-form" method="POST" action="{$self}">
	<input type="hidden" name="login" value="1">
      <h3 class="form-title">Login to your account</h3>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-user"></i>
            <input class="m-wrap" type="text" placeholder="Username" name="username" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-lock"></i>
            <input class="m-wrap" type="password" style="" placeholder="Password" name="password"/>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox">
        <input type="checkbox" /> Remember me
        </label>
	<input type="submit" value="Login" class="btn green pull-right">
  <div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p>
          no worries, click <a href="../dataentry-new/base/forgot.php" class="" id="forget-password">here</a>
          to reset your password.
        </p>
      </div>      
         </div>

  <!-- BEGIN JAVASCRIPTS -->
<script src="assets/js/jquery-1.8.3.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="assets/uniform/jquery.uniform.min.js"></script> 
  <script src="assets/js/jquery.blockui.js"></script>
  <script src="assets/js/app.js"></script>

  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
