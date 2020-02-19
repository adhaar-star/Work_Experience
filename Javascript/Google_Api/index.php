<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>




</head>
<style>



</style>
<body>


<div class="jumbotron">

               <p> <img src="log.png" alt="" style="display: block; margin: 0 auto;" /> </p>
			   <img src="sss.png" alt="" style="display: block; margin: 0 auto;" />
				
</div>

<div class="container">

 <div class="form-group" >
    <form class="form-signin" action="index.php"method="POST" id="login_form" >       
   
      <div class="col-sm-3"><input type="text" class="form-control" name="email" placeholder="Email Address" required="" style="margin-left:400px; margin-top:-30px;"/>
    
      <input type="password" class="form-control" name="pass" placeholder="Password" required=""style="margin-top:5px; margin-left:400px;"/>  <br/>    
     
      <button class="btn btn-lg btn-danger btn-block" type="submit" name="submit" id="btn-login" style="background-color: #660000 ;margin-left:400px;">Login</button>   
    
      <a href="forgotpassword.php" class="btn btn-success btn-md" role="button" style='background-color: #006600;display:block;width: 100%;margin-left:400px;margin-top:10px;'>Forgot Password</a>

	</form>
  
  </div>
	</div> 	</div>    
	
<?php

session_start();
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) 

//if(isset($_POST['submit']))
{
$email = trim($_POST['email']);
$pass = trim($_POST['pass']);

include('dbconnection.php');
$query = "SELECT email, pass,role FROM `login` WHERE email='$email' 
AND pass='$pass'";


$result = mysql_query($query)or die(mysql_error());
$num_row = mysql_num_rows($result);
$row=mysql_fetch_array($result);
if( $num_row ==1 )
     {
 $_SESSION['sess_email']=$row['email'];
  $_SESSION['sess_pass']=$row['pass'];
  
   $query = mysql_query("UPDATE ". login ."  SET date=CURDATE(), time=CURTIME() WHERE email ='$email'"); 
 
   $_SESSION['sess_userrole'] = $row['role'];

       if( $_SESSION['sess_userrole'] == "admin")
  {
	  
	  $_SESSION['login_user']=$row['email'];
   
	  
  ?>
  <script language="javascript" type="text/javascript"> 
     
      window.location = 'forecast.php'; 
    </script>
<?php	
  }

  else
  {
	    $_SESSION['login_user']=$row['email'];
          
  ?>
  <script language="javascript" type="text/javascript"> 
     
      window.location = 'astroforecast.php'; 
    </script>
<?php	
  }
  
  }
  
 else
{
?>
<script language="javascript" type="text/javascript"> 
        alert('Email And Password is Incorrect !!!'); 
     
    </script> 
  
<?php 
}
mysql_close($c);
}
?>


</body>
</html>
