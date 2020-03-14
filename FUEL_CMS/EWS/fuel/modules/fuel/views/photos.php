<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>How To Use jQuery Lightbox With A Database</title>
   

<style>

</style>
</head>
<body>
</br>
<div align='center'>You may click the images below.</div>
</br>
</br>
<?php $id=$_GET['id']; ?>
 <div id='b' style='margin-top:-30px;margin-left:40px;'><a class='btn' style='margin-top:0px;margin-right:2px;' href='http://ews.assertive-media.co.uk/cms/index.php/fuel/jobs/view/<?php echo $id;?>' >BACK</a></div>

<div id="gallery" style="margin-top:50px;"> <!-- id to detect images for lightbox -->
<?php

$dbhost = 'localhost';
$dbuser = 'ewsuser';
$dbpass = 'fuelcms';
$dbname = 'ews';

$conn = $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 


// Database Connection
$sql = "select * from fuel_images where Job_id='$id'"; // Query the photos
$result = mysqli_query( $conn,$sql );


while($row = mysqli_fetch_assoc($result)){ // Loop through the records
	$file_name=$row['Image'];
$thumb_name=$row['thumb_img'];
$Phone_Date=$row['Phone_Date'];
$GPS_date=$row['GPS_date'];
$Uploaded=$row['Uploaded'];
$Crew=$row['Crew'];
$Status=$row['Status'];
$latitude=$row['latitude'];
$longitude=$row['longitude'];
	   
echo "<a href='\EWS\assets\images/$file_name' rel='lightbox[philippines]' title='<br>Phone Date&nbsp;$Phone_Date<br>GPS Date&nbsp;$GPS_date<br>Uploaded&nbsp;$Uploaded<br>Teams&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Crew<br>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$Status<br>latitude&nbsp;&nbsp;&nbsp;&nbsp;$latitude<br>longitude&nbsp;$longitude'>"."  <img src='$thumb_name'  style='margin-left:10px;'/>"."</a>";

}
?>
</div>

	<script type="text/javascript" src="http://ews.assertive-media.co.uk/assets/js/jquery.js">
	</script>
	<script type="text/javascript" src="http://ews.assertive-media.co.uk/assets/js/jquery.lightbox-0.5.js">
	</script>
	<link rel="stylesheet" type="text/css" href="http://ews.assertive-media.co.uk/assets/css/jquery.lightbox-0.5.css" media="screen" />

	<script type="text/javascript">
		// script to activate lightbox
		$(function() {
			$('#gallery a').lightBox({
Height: 200, 
Width: 200
});
		});
	</script>
</body>
</html>