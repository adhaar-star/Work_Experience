<!-- RELATED ITEMS -->
<?php $this->load->module_view(FUEL_FOLDER, '_blocks/related_items'); ?>

<!-- NOTIFICATION EXTRA -->


<!-- WARNING WINDOW -->
<?php $this->load->module_view(FUEL_FOLDER, '_blocks/warning_window'); ?>
 <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
       #map-canvas {
        height: 50%;
        margin-top: -470px;
        padding: 0px
		
      }
	  body {
	  font-family: 'Lucida Grande',Verdana,Arial,Helvetica,Sans-serif;
	  }
	 

.gallery-photos {

    padding: 20px;

}

   #lightbox {
    position:fixed; /* keeps the lightbox window in the current viewport */
    top:0; 
    left:0; 
    width:100%; 
    height:100%; 
    background:url(overlay.png) repeat; 
    text-align:center;
}
#lightbox p {
    text-align:right; 
    color:#fff; 
    margin-right:20px; 
    font-size:12px; 
}
#lightbox img {
    box-shadow:0 0 25px #111;
    -webkit-box-shadow:0 0 25px #111;
    -moz-box-shadow:0 0 25px #111;
    max-width:940px;
}
.tg1  {border-collapse:collapse;border-spacing:0;}
.tg1 td{padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg1 th{ font-weight: 500;
  color: #333;
  padding: 2px 10px;
  border-style: none;
  border-color: #ccc;
  border-width: 1px;
  overflow: hidden;
  word-break: normal;
    text-align: left;}
.tg1 .tg1-rd2y{font-size:12px}
	




.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th {
  text-align: left;
  font-weight: 500;
  color: #333;
  padding: 2px 10px;
  border-style: solid;
  border-color: #ccc;
  border-width: 1px;
  overflow: hidden;
  word-break: normal;
}
.tg .tg-rd2y{font-size:12px}
	
.comment {
margin-left :100px;
}

	
    </style>
<script type="text/javascript" src="js/js/prototype.js"></script>
<script type="text/javascript" src="js/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/js/lightbox.js"></script>
<link rel="stylesheet" href="css/css/lightbox.css" type="text/css" media="screen" />
	

</head>

<div id="fuel_main_content_inner">

	<?php if (!empty($instructions)) : ?>
	<p class="instructions"><?=$instructions?></p>
	<?php endif; ?>

<?php  



$this->load->model('fuel_jobs_model');
 $example = $this->fuel_jobs_model->find_by_key($vars['data'], 'array');


 echo "  
    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
    <script>
	
var map;
var geocoder
var infowindow = new google.maps.InfoWindow();
$(function initialize() {
   geocoder = new google.maps.Geocoder();
   
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  CodeAddress();
});

function CodeAddress() {
  var address  =document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
	
	          infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
			      google.maps.event.addListener(marker, 'click', function(){
       infowindow.open(map, marker);
   });
			 
 } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
	});
	
	}


</script>";
?> 

<?php echo "<table class='tg1'>";

echo "<p>"."<tr>"."<th class='tg1-rd2y'>"."<strong>"."EWS Job Number"."</strong>"."</th>"."<th class='tg1-rd2y'>".$example['EWS_Job_Number']."</th>"."</tr>";	
echo "<tr>"."<th class='tg1-rd2y'>"."<strong>"."Details"."</strong>"."</th>"."<th class='tg1-rd2y'>".$example['Details']."</th>"."</tr>";		
		// save reference it so we can reorder
echo "<tr>"."<th class='tg1-rd2y'>"."<strong>"."Status"."</strong>"."</th>"."<th class='tg1-rd2y'>".$example['Status']."</th>"."</tr>";
echo "<tr>"."<th class='tg1-rd2y'>"."<strong>"."Client Name"."</strong>"."</th>"."<th class='tg1-rd2y'>".$example['Client_Name']."</th>"."</tr>";
echo "<tr>"."<th class='tg1-rd2y'>"."<strong>"."Teams"."</strong>"."</th>"."<th class='tg1-rd2y'>".$example['Contractors_assigned']."</th>"."</tr>";
 ?>	
 <tr><th class='tg1-rd2y'><strong>Street Name</strong></th><th class='tg1-rd2y'><input  type='text' style='margin-top:-100px; width:400px;' id='address1' value="<?php echo $example['street_name'];?>"readonly></th></tr>
 <tr><th class='tg1-rd2y'><strong>House number</strong></th><th class='tg1-rd2y'><input  type='text' style='margin-top:-100px; width:400px;' id='address2' value="<?php echo $example['house_number'];?>"readonly></th></tr>
 <tr><th class='tg1-rd2y'><strong>Location</strong></th><th class='tg1-rd2y'><input  type='text' style='margin-top:-100px; width:400px;' id='address' value="<?php echo $example['Location'];?>"readonly></th></tr>

 </table>
<div id='location' style='margin-left:110px;margin-top:-17px;'><?php echo $example['Location'];?></div>
<?php
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";	
echo "</br>";
echo "</br>";	
echo "</br>";
echo "</br>";	

			
?>

  
<div id="status" style="margin-top:-400px;">  
<p></p>
<strong>Status History</strong>
</br>
<table class="tg">
<tr>
<th class="tg-rd2y">Status</th>                                     
<th class="tg-rd2y">Changed to</th>
<th class="tg-rd2y"> Time  &  Date</th>
</tr>
<?php
echo "</br>";
                         
			


	 
 $this->db->where('job_id',$vars['data']);
 $this->db->order_by("id", "desc");
	$query = $this->db->get('fuel_status_history');

foreach ($query->result() as $row)
{
  if(($row->Old_status)!="")
{
	echo "<tr>";
    echo "<th class='tg-rd2y'>".$row->Old_status."</th>";
	echo "<th class='tg-rd2y'>".$row->New_status."</th>";
	echo "<th class='tg-rd2y'>".$row->Updated."</th>";
	echo "</tr>";
	}
}
echo "</table>";
echo  "</br>";  
echo  "</br>";  
echo  "</br>";                             
 ?></div>
 <strong>Comments</strong>
<?php echo "<div class ='comment'>".$example['Comments']."</div>";
echo "</br>";



?>
</div> 
 <div id="link" style="margin-top:0px; margin-left:35px;"><a class="btn" href="/EWS/index.php/fuel/Photos/?id=<?php echo $example['id'];?>">View Photos</a></div></div>
  <div id="map-canvas" style="height:400px; width:300px; margin-top:30px; margin-right:200px; border:solid 2px; float:right;"></div></br></br>

  </body>
 </div>