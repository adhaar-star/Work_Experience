<style>
	.imageload{
	display: none;
    margin: 0 0 -7px 8px;
    width: 24px;
	}
	
	
	</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('.update').click(function () {
		//alert("sds");
        $(this).parent().find('img.imageload').show();
    });
});

	</script>
<?php

$con=mysqli_connect("localhost","root","Admin123","phplist");
// Check connection
if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
// Open a known directory, and proceed to read its contents
$sql="SELECT * FROM `phplist_list`";
$result=mysqli_query($con,$sql);

// Numeric array\
$list=array();
$listid=array();

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
array_push($list,$row['name']);
	array_push($listid,$row['id']);
}


$h = opendir('files/'); //Open the current directory
$counter=0;
while (false !== ($entry = readdir($h))) {
    if($entry != '.' && $entry != '..') { //Skips over . and ..
		$counter++;
       ?> <form action='insert.php' method='post' name='registerForm'><input type='hidden' name='emails' value='<?php  echo $entry;  ?>'/>filename :<?php  echo $entry;  ?>    <select id='subscriberlist' name="subscriberlistid">   <?php
    foreach($list as $key=>$value) { ?>
      <option value="<?php echo $listid[$key] ?>"><?php echo $value; ?></option>
  <?php
    } ?></select>  <input type='submit' name='submit' class='update'  value='update'><img src='preloader.gif' data-id='<?php echo $counter;?>' class='imageload'/></form>
<?php
    }
}
	
if(isset($_POST['submit'])) {
    $myFile = $_POST['emails'];
	$listid = $_POST['subscriberlistid'];
	$dir='files/';
$fh = fopen($dir.$myFile, 'r');
$contents = file_get_contents($dir.$myFile);
$pollfields = explode(',', $contents);
	fclose($fh);
	//$pollfields = explode(',',$myFile);
//print_r($theData);die;
	?>

<?php
$userid=array();
foreach($pollfields as $field) {

	 mysqli_query($con,"INSERT INTO phplist_user_user (email,confirmed) VALUES('$field',1)");
        $userid =mysqli_insert_id($con);
		 mysqli_query($con,"INSERT phplist_listuser (userid,listid,entered) VALUES($userid,$listid,now())");
}
	?>
<script>
$('.imageload').hide();

	</script>
<?php
/*while (!feof($fh)) {
   $line = fgets($fh);
	$value=rtrim($line,',');
	echo $value;
 // mysqli_query($con,"INSERT INTO phplist_user_user (email) VALUES('$value')");
	
}*/


$emails="";

	mysqli_close($con);
}

?>