<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>How To Use jQuery Lightbox With A Database</title>
	<style>
	body {
	  font-family: 'Lucida Grande',Verdana,Arial,Helvetica,Sans-serif;
	  }
  
	  </style>
</head>

<body>

<div id="gallery"> <!-- id to detect images for lightbox -->
<?php

$dbhost = 'localhost';
$dbuser = 'ewsuser';
$dbpass = 'fuelcms';
$dbname = 'ews';

$conn = $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 


$Image=$_GET['Image'];
$id=$_GET['id'];
echo '</br>';
echo "<div id='a' style='margin-left:100px;margin-top:40px;'><a class='btn' href='/index.php/fuel/Photos/?id=$id'>BACK</a></div>"."</br>";
echo "<div style='margin-left:280px;'>"."Image:".$Image."</div>"."</br>";
// Database Connection
$sql = "select * from fuel_images where Image='$Image'"; // Query the photos
$result = mysqli_query( $conn,$sql );
?>
<div id='Image'  style='margin-top:200px;'>
<?php
    
while($row = mysqli_fetch_assoc($result)){ // Loop through the records
      echo "<p style='font-family: Lucida Grande',Verdana,Arial,Helvetica,Sans-serif;'>"."<pre>"."         "."                                "."<img src='http://$Image' style='height:250px; width:250px; margin-top:-200px; margin-left:160px;'  />"."</pre>".'</br>'.'</br>'.'</br>'.'</br>'.'</br>';
  

	echo   "<pre>"."                                      "."<strong>"."Phone_Date"."</strong>"."                                                               ".$row['Phone_Date'].'</br>';
	echo   "<pre>"."                                      "."<strong>"."GPS_date"."</strong>"."                                                                  ".$row['GPS_date'].'</br>';
	echo   "<pre>"."                                      "."<strong>"."Uploaded"."</strong>"."                                                                  ".$row['Uploaded'].'</br>';
	echo   "<pre>"."                                      "."<strong>"."Crew"."</strong>"."                                                                      ".$row['Crew'].'</br>';
	echo   "<pre>"."                                      "."<strong>"."Status"."</strong>"."                                                                    ".$row['Status'].'</br>';
	
	echo   "<pre>"."                                      ".'<b>'."Latitude".'</b>'."                                                                  ".$row['latitude'].'</br>';
	echo   "<pre>"."                                      "."<strong>"."Longitude"."</strong>"."                                                                 ".$row['longitude'].'</br>'.'</p>';
	
	
}
?>
</div>
</div>
	
	
</body>
</html>