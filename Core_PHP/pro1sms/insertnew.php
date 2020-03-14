<style>
	.form_outer {
		margin: 20px auto;
		max-width: 650px;
		width:100%;
	}
	.imageload{
		display: none;
		margin: 0 0 -7px 8px;
		width: 24px;
	}	
	.form_outer h3 {
		border-bottom: 1px solid #ccc;
		box-sizing: border-box;
		color: #868686;
		float: left;
		margin: 25px 0;
		padding: 0 15px 20px;
		width: 100%;
	}
	.form_top > form, .form_bottom > form {
		border-bottom: 1px solid #ccc;
		padding: 0 15px 15px;
	}
	.form_top > form:last-child, .form_bottom > form:last-child	{
		border:none;
	}
	.form_top, .form_bottom {
		border: 1px solid #ccc;
		margin:0 0 20px;
	}
	.directorycheck {
		padding: 0 15px 15px;
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
$(document).ready(function () {
    $('.delete').click(function () {
		//alert("sds");
        $(this).parent().find('img.imageload').show();
    });
});
	</script>
<?php
ini_set('memory_limit', '-1');


$con=mysqli_connect("localhost","root","Admin123","phplist");
//$con=mysqli_connect("localhost","root","","phplistdb");

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
?>
<div class="form_outer">
	<div class="form_top">
		<h3>Insert Emails</h3>
			<form action='insertnew.php' method='post' name='listdirectory'>Enter directory:
				<input type='text'  id='directory' name='directory' />    <input type='submit' name='getfolder' class='getdirectory'  value='submit'>
			</form>

<?php
//Open the current directory
if(isset($_POST['getfolder'])) {
	$directory = $_POST['directory'];
	$foldercontents='files/'.$directory.'/';
	if (file_exists($foldercontents)) {
		$q      =       (count(glob("$foldercontents/*")) === 0) ? 'Empty' : 'Not empty';
if($q=="Empty"){
echo "<div class='directorycheck' >The Directory is empty</div>";
}else{
	$h = opendir($foldercontents); 

while (false !== ($entry = readdir($h))) {
    if($entry != '.' && $entry != '..') { //Skips over . and ..
		$counter=0;
		if(is_file($foldercontents.$entry)){
		$counter++;
       ?> <form action='insertnew.php' method='post' name='registerForm'><input type='hidden' name='contents' value='<?php  echo $directory;  ?>'/><input type='hidden' name='emails' value='<?php  echo $entry;  ?>'/>filename :<?php  echo $entry;  ?>    <select id='subscriberlist' name="subscriberlistid">   <?php
    foreach($list as $key=>$value) { ?>
      <option value="<?php echo $listid[$key] ?>"><?php echo $value; ?></option>
  <?php
    } ?></select>  <input type='submit' name='submit' class='update'  value='update'><img src='preloader.gif' data-id='<?php echo $counter;?>' class='imageload'/></form>
<?php
		}
    }
}
	if($counter==0){
			echo "<div class='directorycheck' >Directory is empty</div>";
			}
	}
	}
	else{
	echo "<div class='directorycheck' >Directory not found</div>";
	}	
}
?>
</div>
<div class="form_bottom">
	<h3>Empty List</h3>
<form action='insertnew.php' method='post' name='deleteForm' ><select id='deletesubscriberlistid' name="deletesubscriberlistid">   <?php
    foreach($list as $key=>$value) { ?>
      <option value="<?php echo $listid[$key] ?>"><?php echo $value; ?></option>
  <?php
    } ?></select> <input type='submit' name='delete' class='delete'  value='truncate'><img src='preloader.gif' data-id='<?php echo $counter;?>' class='imageload'/></form>
<?php

if(isset($_POST['submit'])) {
    $myFile = $_POST['emails'];
		 $folder = $_POST['contents'];
	$listid = $_POST['subscriberlistid'];
	
		$dir='files/'.$folder.'/';
$fh = fopen($dir.$myFile, 'r');
$contents = file_get_contents($dir.$myFile);
	
$pollfields = explode(',', $contents);
	fclose($fh);
	//$pollfields = explode(',',$myFile);
//print_r($theData);die;
	?>

<?php
//$array = array("array", "with", "about", "2000", "values");
$query = "INSERT INTO phplist_user_user (email,confirmed) VALUES (?,1)";
if(($stmt = mysqli_prepare($con,$query)) === false)
{
  die("unable to prepare");
}
$confirmed=1;
if(!mysqli_query($con,"START TRANSACTION")){
  die("unable to start transaction");
}	
$counter=0;
foreach ($pollfields as $one) {
	if(!mysqli_stmt_bind_param($stmt, "s", $one)) {
	 die("binding error");
	}
//ini_set('memory_limit', '-1');
    if(!mysqli_stmt_execute($stmt)) {
die('execute() failed: ' . htmlspecialchars($stmt->error));	}
	$userid[]=mysqli_insert_id($con);
	$counter++;
}
mysqli_stmt_close($stmt);
	
if(!mysqli_query($con,"COMMIT")){
  die("unable to commit");
}	

	
	


$query2 = "INSERT INTO phplist_listuser (userid,listid,entered) VALUES (?,$listid,now())";
if(($stmt2 = mysqli_prepare($con,$query2)) === false)
{
  die("unable to prepare");
}

if(!mysqli_query($con,"START TRANSACTION")){
  die("unable to start transaction");
}	
$counter2=0;
foreach ($userid as $two) {
	if(!mysqli_stmt_bind_param($stmt2, "s", $two)) {
	 die("binding error");
	}
ini_set('memory_limit', '-1');
    if(!mysqli_stmt_execute($stmt2)) {
		die("execution error2");
	}
	
	$counter2++;
}
mysqli_stmt_close($stmt2);
	
if(!mysqli_query($con,"COMMIT")){
  die("unable to commit");
}	
	echo "Records successfully inserted";
	
/*$userid=array();
	mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_ONLY);
foreach($pollfields as $field) {

	 mysqli_query($con,"INSERT INTO phplist_user_user (email,confirmed) VALUES('$field',1)");
        $userid =mysqli_insert_id($con);
		 mysqli_query($con,"INSERT phplist_listuser (userid,listid,entered) VALUES($userid,$listid,now())");
	
}
	mysqli_commit($con);*/
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


if(isset($_POST['delete'])) {


    //$myFile = $_POST['emails'];
	$listid = $_POST['deletesubscriberlistid'];
	$dir='files/';
//$fh = fopen($dir.$myFile, 'r');
//$contents = file_get_contents($dir.$myFile);
//$pollfields = explode(',', $contents);
//	fclose($fh);
	//$pollfields = explode(',',$myFile);
//print_r($theData);die;
	?>

<?php
//$userid=array();
/*foreach($pollfields as $field) {

	$items[] = '(2,' . $item.')';
	 mysqli_query($con,"INSERT INTO phplist_user_user (email,confirmed) VALUES('$field',1)");
        $userid[] =mysqli_insert_id($con);
		 mysqli_query($con,"INSERT phplist_listuser (userid,listid,entered) VALUES($userid,$listid,now())");
}*/
	
	//$result = "'" . implode ( "', '", $pollfields) . "'";


	//echo $result;die;
	
	
	$result2=mysqli_query($con,"SELECT * FROM `phplist_listuser` WHERE listid='$listid'");
  $rowcount=mysqli_num_rows($result2);

	
	

	if($rowcount>0){
	if (!mysqli_query($con,"	DELETE FROM `phplist_listuser`, `phplist_user_user` 
  USING `phplist_listuser` 
  INNER JOIN `phplist_user_user` ON `phplist_listuser`.`userid` = `phplist_user_user`.`id` 
  WHERE `phplist_listuser`.`listid`= '$listid'"))
  {
  echo("Error description: " . mysqli_error($con));
  }else{
			?>
<script>
$('.imageload').hide();

	</script>
<?php
	echo "Users of selected list deleted successfully";
	}
	}
	else{
	echo "No users in this list";
	}
	
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
</div>
</div>