<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>Metronic Admin Dashboard Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/metro.css" rel="stylesheet" />
  <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="../assets/css/style.css" rel="stylesheet" />
  <link href="../assets/css/style_responsive.css" rel="stylesheet" />
  <link href="../assets/css/style_default.css" rel="stylesheet" id="style_color" />
  <link rel="../stylesheet" type="text/css" href="assets/uniform/css/uniform.default.css" />
</head>

<body class="login">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <img src="../images/logo.gif" alt="" /> 
  </div>
  <!-- END LOGO -->
  <!-- BEGIN LOGIN -->
  <div class="content">
 <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="form-vertical" action="forgot.php" method="post">
      <h3 class="">Forget Password ?</h3>
      <p>Enter your e-mail address below to reset your password.</p>
      <div class="control-group">
        <div class="controls">
          <div class="input-icon left">
            <i class="icon-envelope"></i>
            <input class="m-wrap"  type="text" name="email" placeholder="Email" />
          </div>
        </div>
      </div>
      <div class="form-actions">
        <a href="../index.php" id="back-btn" class="btn">
        <i class="m-icon-swapleft"></i> Back
        </a>
<input id="forget-btn" class="btn green pull-right" type="submit" name="submit" value="Send">
            
      </div>
    </form>
  

<?php 
error_reporting(0);
$email=$_POST['email'];
if($_POST['submit']=='Send')
{
mysql_connect('mysql.mysql1.cp247.net','vendingadmin2015','pT#7JR8-2s3gN@@s') or die(mysql_error);
mysql_select_db('vendingadministration');
$query="select * from staff where email='$email'";
$result=mysql_query($query) or die(error);
if(mysql_num_rows($result))
{
$npw=mt_rand(10000,99999);
$npwd=md5($npw);
$msg='We received a request to reset the password for your account.</br>Your new password is:'.$npw.'</br></br>Please do not reply to this message; it was sent from an unmonitored email address. This message is a service email related to reset password.';
//$footer="Please do not reply to this message; it was sent from an unmonitored email address. This message is a service email related to your use of Admin"; 
// Always set content-type when sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@mightyvending.net>' . "\r\n";
mail($email, "Your new password",$msg,$headers);
echo "<span style='color: #f00;font-size: 20px;'>Email Sent</span>";
}
else
{
echo "<span style='color: #f00;font-size: 20px;'>No user exist with this email id</span>";
}

mysql_query("UPDATE staff set password='$npwd' where email='$email'");
}
?>
  <!-- END FORGOT PASSWORD FORM -->
 </div>
</body>
<!-- END BODY -->
</html>



