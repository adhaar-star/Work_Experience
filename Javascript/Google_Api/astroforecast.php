 <?php  include('session.php');?>
 
  
	
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
	
     <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places">
</script>
	 <script src="/AstroAssure_pre/Date.js"></script>		
		
	
    <title>Directions service (complex)</title>
    <style>
	
	 html, body, .container-fluid, .row, .map { height: 102% }

#map-canvas {

    height: 100%;
 	
	width: 127.999%;

}
#forecast
	  {
	  margin-top:150px;
	margin-bottom:20px;
	  
	  }
	  
	  #siteloader1
	  {
	  display:none;
	  }
	  
	    #siteloader5
	  {
	  display:none;
	  }
	   #red
	  {
	  display:none;
	  }
	   #yellow
	  {
	  display:none;
	  }
	   #orange
	  {
	  display:none;
	  }
	 
	 p.small {
    line-height: 170%;
}
	
	#r {

    height: auto;
	width:  auto;
    background: -webkit-linear-gradient(#E6F0FF,#FFFFFF,#FFFFFF, #CEE6FF); /* For Safari 5.1 to 6.0 */
 
}
	div#myInput {
    background-color:yellow;
   
   
}
#popup {
   display:none;
    position:absolute;
   background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
	margin-left:170;
    bottom: 39px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 220px;
}
.pagination li{
	display:inline-flex;

	
	margin-right: -1px;
	font: 15px/20px Arial, Helvetica, sans-serif;
	background: #FFFFFF;
	box-shadow: inset 1px 1px 5px #F4F4F4;
}
.pagination li a{
    text-decoration:none;
    color: rgb(89, 141, 235);
}
.pagination li.first {
    border-radius: 5px 0px 0px 5px;
}
.pagination li.last {
    border-radius: 0px 5px 5px 0px;
}
.pagination li:hover{
	background: #CFF;
}
.pagination li.active{
	display:inline-flex;
	background: #F0F0F0;
	border: 1px solid #ddd;
   
	padding: 6px 10px 6px 10px;
	color: #333;
}
  </style>
  <script>
   $(document).ready(function(){
   	var a = document.getElementById("selectloaddate");


var b= document.getElementById("selectdate");
 function pad(s) { return (s < 10) ? '0' + s : s; }
var someDate = new Date();
var dd = someDate.getDate();
var mm = someDate.getMonth() + 1;
var yy = someDate.getFullYear();

	
a[0].innerHTML=Date.today().toString("MM/dd/yyyy");;
a[1].innerHTML=Date.today().add(1).days().toString("MM/dd/yyyy");;
a[2].innerHTML=Date.today().add(2).days().toString("MM/dd/yyyy");;


	
b[0].innerHTML=Date.today().add(1).days().toString("MM/dd/yyyy");;
b[1].innerHTML=Date.today().add(2).days().toString("MM/dd/yyyy");;
b[2].innerHTML=Date.today().add(3).days().toString("MM/dd/yyyy");;
	});
	</script>
  
   <script> 

  
             $(document).ready(function(){ 
			   $("#Select2").mouseover(function() {
    $('#popup').show();
}).mouseout(function() {
 $('#popup').hide();
});
				   $('#warnings').hide();
    $("#radios input").change(function() {

        var selectedValue = $(this).val();

        if (selectedValue == "yes") {
           $find('autoCompleteExtender').set_serviceMethod('AutoCompleteExtenderMethod1');

        }
        else if (selectedValue == "no") {
          $find('autoCompleteExtender').set_serviceMethod('AutoCompleteExtenderMethod2');

        }
       
//force click on text box
     $('#autocomplete').click()
      $('#autocomplete').focus();
    });
//handle click event
   
    })

    </script>
       <script>
             $(document).ready(function(){
    $("#radios input").change(function() {

        var selectedValue = $(this).val();

        if (selectedValue == "yes") {
           $find('autoCompleteExtender').set_serviceMethod('AutoCompleteExtenderMethod1');

        }
        else if (selectedValue == "no") {
          $find('autoCompleteExtender').set_serviceMethod('AutoCompleteExtenderMethod2');

        }
       
//force click on text box
     $('#autocomplete1').click()
      $('#autocomplete1').focus();
    });
//handle click event
 
    })

    </script>
	
	

	<script type="text/javascript">
$(document).ready(function() {
   $('#clickme1').click(function(){
      $('#siteloader1').show();
	  $('#siteloader').hide();
   });
   
   $('#clickme2').click(function(){
      $('#siteloader1').hide();
	  $('#siteloader').show();
   });
});

</script>
	
<script type="text/javascript">
$(document).ready(function() {
   $('#load').click(function(){

	  $('#warning_section').hide();
	  $('#loading_section').show();
	   $('#load').hide();
	      $('#ship').show();
		   
   });
   
   $('#ship').click(function(){
     
	  $('#warning_section').show();
	   $('#loading_section').hide();
	  $('#ship').hide();
	    $('#load').show();
   });
});

</script>
  
        </script>
   <script type="text/javascript">
            $(document).ready(function(){
               $('#clickme3').click(function(){
      $('#siteloader5').show();
	  $('#siteloader').hide();
	
   });
   $("#siteloader5").on( "click", ".pagination a", function (e){
        e.preventDefault();

        var page = $(this).attr("data-page"); //get page number from link
 $("#siteloader3").load("forecast2.php",{"page":page}, function(){ //get content from PHP page
        
        });
   });
   $('#clickme4').click(function(){
      $('#siteloader5').hide();
	  $('#siteloader').show();
   });
            });
        </script>
<script>
$(document).ready(function() {
	$('#feedback').click(function(){
      $('#feedbackform').show();
	  $('#siteloader').hide();
   });
   
   $('#main').click(function(){
      $('#feedbackform').hide();
	  $('#siteloader').show();
   });
	
	});
	</script>
	<script>
	var map;

function initialize() {

map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: {lat: 29.7604, lng: -95.3698,},
    zoom: 4
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
	
	</script>
	
	
<script>
	
var map;
var directionsDisplay;
var stepDisplay;
var markerArray = [];


 var autocomplete;
			var autocomplete1;
           


var directionsService = new google.maps.DirectionsService();
function initialize3() {
			 
      

   
 directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
  
    
  };

	directionsDisplay.setMap(map);

  var input = /** @type {HTMLInputElement} */(
      document.getElementById('autocomplete'));

    var types = document.getElementById('type-selector');
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
  
  var autocomplete = new google.maps.places.Autocomplete(input);
  
  autocomplete.bindTo('bounds', map);
 
	
	
	

 var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
document.getElementById("ddlViewBy").selectedIndex=0;
$('#delete').hide();
$('#save').show();
    infowindow.close();
    marker.setVisible(true);
    var place = autocomplete.getPlace();

    if (!place.geometry) {
      return;
    }
	// If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
  marker.setPosition(place.geometry.location);
    marker.setVisible(true);
   calcRoute();
});
///////////////////////////////////////////////////////////////////////////////////
 

 
  var input1 = /** @type {HTMLInputElement} */(
      document.getElementById('autocomplete1'));

    var types1 = document.getElementById('type-selector');
//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input1);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types1);
  
  var autocomplete1 = new google.maps.places.Autocomplete(input1);
  autocomplete1.bindTo('bounds', map);
 

google.maps.event.addListener( autocomplete1,'place_changed', function() {
document.getElementById("ddlViewBy").selectedIndex=0;
$('#delete').hide();
$('#save').show();
    infowindow.close();

    var place1 = autocomplete1.getPlace();
	

	// If the place has a geometry, then present it on a map.
   
    if (place1.geometry.viewport) {
      map.fitBounds(place1.geometry.viewport);
    } else {
      map.setCenter(place1.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setPosition(place1.geometry.location);
    marker.setVisible(true);
	calcRoute();
});


  
}
 

//////////////////////////////////////////////////////////////////////////////////////////////
 
 
 
 function calcRoute() {

  // First, remove any existing markers from the map.
  for (var i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(null);
  }

  // Now, clear the array itself.
  markerArray = [];
 
  // Retrieve the start and end locations and create
  // a DirectionsRequest using WALKING directions.
  var start = document.getElementById('autocomplete').value;
  var end = document.getElementById('autocomplete1').value;
  var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };

  // Route the directions and pass the response to a
  // function to create markers for each step.
   directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      var warnings = document.getElementById('warnings_panel');
      warnings.innerHTML = '<b>' + response.routes[0].warnings + '</b>';
      directionsDisplay.setDirections(response);

    var time= "<br/><strong>Estimated Transit time:</strong> "+response.routes[0].legs[0].duration.text;
    document.getElementById("info1").innerHTML = time;
    }
  });

}
google.maps.event.addDomListener(window, 'load', initialize3);
</script>




<script type="text/javascript">

	var location1;
	var location2;
	var directionsDisplay;
    var directionsService;
	var stepDisplay;
    var markersArray = [];
	var lines=[];
	var address1;
	var address2;

	var checkdistances=[];
	var geocoder;
	var map;
	
	var distance;
	
	// finds the coordinates for the two locations and calls the showMap() function
function initialize1()
	{
	
      
map=new Map();
map.clear();
	 	$('#info1').hide();
		$('#orange').hide();
	$('#red').hide();
	$('#yellow').hide();
	 $('#warnings').hide();
	
	directionsService = new google.maps.DirectionsService();
		geocoder = new google.maps.Geocoder(); // creating a new geocode object
		document.getElementById('info').innerHTML="";
		// getting the two address values
		address1 = document.getElementById("autocomplete").value;
		address2 = document.getElementById("autocomplete1").value;
		
		// finding out the coordinates
		if (geocoder) 
		{
		
				
			geocoder.geocode( { 'address': address1}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					//location of first address (latitude + longitude)
					location1 = results[0].geometry.location;
					
				} else 
				{
				alert("Enter Starting address");
  $("#popup").animate({'margin-bottom': "-30px"});
				}
				geocoder.geocode( { 'address': address2}, function(results, status) 
			{
				if (status == google.maps.GeocoderStatus.OK) 
				{
					//location of second address (latitude + longitude)
					location2 = results[0].geometry.location;
					
					// calling the showMap() function to create and show the map 
					showMap();
				} else 
				{
					alert("Enter Destination address");
  $("#popup").animate({'margin-bottom': "-30px"});
				}
			});
			});
		}
 $("#calculate").attr("disabled", "disabled"); // disable button
    window.setTimeout(function() {
       $("#calculate").removeAttr("disabled"); // enable button
    }, 2000);
 
	}
		 var markers = [];
	// creates and shows the map
	function showMap()
	{
		
	if(address1!="" && address2!="" ){
	 $('#loading-indicator').show();
}
		var f = document.getElementById("selectroute");
var strUser2 =f.selectedIndex;

		// center of the map (compute the mean value between the two locations)
		latlng = new google.maps.LatLng((location1.lat()+location2.lat())/2,(location1.lng()+location2.lng())/2);
		var v =  document.getElementById("Select2").value;
	 var waypts = [];
	  var chicago = new google.maps.LatLng(41.850033, -87.6500523);
	   if (v=='yes') {
		   
      waypts.push({
          location:chicago,
          stopover:true});
    }
	
	
	
		// set map options
			// set zoom level
			// set center
			// map type
		var mapOptions = 
		{
			zoom: 4,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		// create a new map object
			// set the div id where it will be shown
			// set the map options
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		 
		  var rendererOptions = {
		  
    map: map,
	
  }

		// show route between the points
		directionsService = new google.maps.DirectionsService();
		directionsDisplay = new google.maps.DirectionsRenderer(
		{

		
			suppressInfoWindows: true
		});
	
		var radio = document.getElementById('radios').value;
if (document.getElementById('Select2').checked) {
 var v = document.getElementById('Select2').value;
}
if (document.getElementById('Select3').checked) {
 var v = document.getElementById('Select3').value;
}
var t = document.getElementById("mySelect").value;
 

 
if(strUser2==0){
	if(v=='yes' && t>=1)
{
		var request = {
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
		var request = {
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
}
else if(strUser2==2 && t>=1)
		{
			if(address1=='Chicago, IL, United States' ){
	if(address2=='Portland, OR, United States'||address2=='Seattle, WA, United States'||address2=='Spokane, WA, United States')			{
			var LatLng21 = new google.maps.LatLng(40.7607793, -111.8910474);
			location2=LatLng21;
			 directionsDisplay.setMap(map);

				var request = {
			origin:location1, 
			destination:location2,
			
    
		travelMode: google.maps.TravelMode.TRANSIT,
  transitOptions: {
    
    modes: [google.maps.TransitMode.RAIL],
	routingPreference: google.maps.TransitRoutePreference.FEWER_TRANSFERS
    
  },
   unitSystem: google.maps.UnitSystem.METRIC
		};
		  directionsDisplay.setMap(null);
			}
			else{
						alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
				}
			}
			
			else if(address2=='Chicago, IL, United States'){
					if(address1=='Portland, OR, United States'||address1=='Seattle, WA, United States'||address1=='Spokane, WA, United States')
			{
				var LatLng24 = new google.maps.LatLng(41.850033, -87.6500523);
			location2=LatLng24;
				var LatLng23 = new google.maps.LatLng(40.7607793, -111.8910474);
			location1=LatLng23;
				directionsDisplay.setMap(map);
		
				var request = {
			origin:location1, 
			destination:location2,
			
    
		travelMode: google.maps.TravelMode.TRANSIT,
  transitOptions: {
    
    modes: [google.maps.TransitMode.RAIL],
	routingPreference: google.maps.TransitRoutePreference.FEWER_TRANSFERS
    
  },
   unitSystem: google.maps.UnitSystem.METRIC
		}
		directionsDisplay.setMap(null);
				}
				else{
					
								alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
				}
			}
			else{
								alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
			
			}
	 
		}
		else if(strUser2==1 && t>=1)
		{
			if(address1=='Chicago, IL, United States' ){
	if(address2=='Portland, OR, United States'||address2=='Seattle, WA, United States'||address2=='Spokane, WA, United States')			{
			  
		var request = {
			origin:location1, 
			destination:location2,
	
    
		travelMode: google.maps.TravelMode.TRANSIT,
  transitOptions: {
    
    modes: [google.maps.TransitMode.RAIL],
	routingPreference: google.maps.TransitRoutePreference.FEWER_TRANSFERS
    
  },
   unitSystem: google.maps.UnitSystem.METRIC
		};
		  directionsDisplay.setMap(null);
			}
			else{
						alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
				}
			}
			
			else if(address2=='Chicago, IL, United States'){
					if(address1=='Portland, OR, United States'||address1=='Seattle, WA, United States'||address1=='Spokane, WA, United States')
			{
				  
		var request = {
			origin:location1, 
			destination:location2,
	
    
		travelMode: google.maps.TravelMode.TRANSIT,
  transitOptions: {
    
    modes: [google.maps.TransitMode.RAIL],
	routingPreference: google.maps.TransitRoutePreference.FEWER_TRANSFERS
    
  },
   unitSystem: google.maps.UnitSystem.METRIC
		};
		directionsDisplay.setMap(null);
				}
				else{
					
								alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
				}
			}
			else{
								alert("There is no route with this Route type");
						if(v=='yes' && t>=1)
{
		var request = {
			
			origin:location1, 
			destination:location2,
			waypoints: waypts,
    
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};
		}
		else{
			
		var request = {
			
			origin:location1, 
			destination:location2,
			
    
			 travelMode:google.maps.DirectionsTravelMode.DRIVING,
		}};
			
			}
	 
		}

		if(v=='yes' && t<=2)
  {
  directionsDisplay.setMap(map);
  }
		
		directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				
				getCoordinates(response);
				
			}
			else{
			alert("There is no route with this Route type");
			 $('#loading-indicator').hide();
			marker1.setMap(null);
			marker2.setMap(null);
  }
});
				
	
			
		
		// show a line between the two points
		
		// create the markers for the two locations		
	var marker1 = new google.maps.Marker({
			map: map, 
			position: location1,
			  icon:'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
			title: "First location"
		});
		
		var marker2 = new google.maps.Marker({
			map: map, 
			position: location2,
			icon:'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
			title: "Second location"
		});
		
		// create the text to be shown in the infowindows
		var text1 = '<div id="content">'+
				'<h1 id="firstHeading">Shipping location</h1>'+
				'<div id="bodyContent">'+
				'<p>Coordinates: '+location1+'</p>'+
				'<p>Address: '+address1+'</p>'+
				'</div>'+
				'</div>';
				
		var text2 = '<div id="content">'+
			'<h1 id="firstHeading">Destination</h1>'+
			'<div id="bodyContent">'+
			'<p>Coordinates: '+location2+'</p>'+
			'<p>Address: '+address2+'</p>'+
			'</div>'+
			'</div>';
		
		// create info boxes for the two markers
		var infowindow1 = new google.maps.InfoWindow({
			content: text1
		});
		var infowindow2 = new google.maps.InfoWindow({
			content: text2
		});

		// add action events so the info windows will be shown when the marker is clicked
		google.maps.event.addListener(marker1, 'click', function() {
			infowindow1.open(map,marker1);
		});
		google.maps.event.addListener(marker2, 'click', function() {
			infowindow2.open(map,marker2);
		});
		
	
		
		function getCoordinates(response) {
				var e = document.getElementById("selectdate");
var strUser =e.selectedIndex;

var new1=(strUser-1);
if(strUser2==2){
	startdetails2(address1,new1);
}
var s2 = document.getElementById("selectloaddate");
var strUser3 =s2.selectedIndex;

            var currentRouteArray = response.routes[0];  //Returns a complex object containing the results of the current route
		
            var currentRoute = currentRouteArray.overview_path;
			//Returns a simplified version of all the coordinates on the path
			
			
		
			var distance2=(getDistanceFromLatLonInKm(location1.lat(),location1.lng(),location2.lat(),location2.lng()).toFixed(1));
			
			var checkdistances1=[];	
var distance3=(getDistanceFromLatLonInKm2(location1.lat(),location1.lng(),41.850033,-87.6500523));
var distance8=(getDistanceFromLatLonInKm4(41.850033,-87.6500523,location2.lat(),location2.lng()));	

				function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius                                                      sof the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}
function deg2rad(deg) {
  return deg * (Math.PI/180)
}	
function getDistanceFromLatLonInKm2(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}	
	function deg2rad(deg) {
  return deg * (Math.PI/180)
}		
function getDistanceFromLatLonInKm4(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}	
	function deg2rad(deg) {
  return deg * (Math.PI/180)
}				
var t = document.getElementById("mySelect").value;
	
	
	var t1;
	if(v=="yes")
	{
	t1=t-1;
	
	}
	else
	{
	t1=t-1;
	}
if(v!="yes" && t1<2)
{
directionsDisplay.setMap(map);
 }

 
            obj_newPolyline = new google.maps.Polyline(); //a polyline just to verify my code is fetching the coordinates
            var path = obj_newPolyline.getPath();
			
			 for (var j = 0; j < currentRoute.length; j++) {
			 if (j== currentRoute.length-1)
			 {
			 var pos = new google.maps.LatLng(currentRoute[j].lat(), currentRoute[j].lng())
			  var R = 6371; 
		var dLat = toRad(location1.lat()-pos.lat());
		var dLon = toRad(location1.lng()-pos.lng()); 
		
		var dLat1 = toRad(location1.lat());
		var dLat2 = toRad(pos.lat());
		
		var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
				Math.cos(dLat1) * Math.cos(dLat1) * 
				Math.sin(dLon/2) * Math.sin(dLon/2); 
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		
		var degToRad= Math.PI/180.0;



			
	var distance4 = R * c;
	
	
	 if(v=='yes' && strUser2==0){
	if(distance3>(distance2))
	{

	var p=((distance4+800)/(t));
	
	
	}
	else{
	
		var	p=((distance3+distance8)/t);
		
		}
	}
	
		else{
		
			var	p=(distance2/t);
			}
			
			 }
			 }
			
			
			
			
		
		
			var DrivePath=[];
			var latArray=[];
			var lngArray=[];
			var distances=[];
			var positions=[];
			var counter=0;
			var count=0;
			var count1=0;
			var count2=0;
			var count3=0;
			var count4=0;
			var count5=0;
			var count6=0;
				var countp=0;
				var counth=0;
				var kcount=0;
				var fcount=0;
                       var placecounter=0;
            for (var x = 0; x < currentRoute.length; x++) {
                var pos = new google.maps.LatLng(currentRoute[x].lat(), currentRoute[x].lng())
             latArray[x] = currentRoute[x].lat(); //Returns the latitude
                lngArray[x] = currentRoute[x].lng(); //Returns the longitude
				 path.push(pos);
				 
				




  
		



function getDistance(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}
	var distance5=getDistance(location1.lat(),location1.lng(),pos.lat(),pos.lng());
if(v=='yes'){
	if(distance5>distance3){
		 var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(pos.lat()-41.850033);  // deg2rad below
  var dLon = deg2rad(pos.lng()-(-87.6500523)); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(pos.lat())) * Math.cos(deg2rad(41.850033)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Dis
  var distance7=d+distance3;
	}
	else{
		var distance7=distance5;
	}
	}
	else{
		var distance7=distance5;
	}
function deg2rad(deg) {
  return deg * (Math.PI/180)
}
			
	
	    var d1 = distance7;
	
	
	     distances[x] = d1;
		
		 var d2=distances[x-1];
		positions[x]  =  pos;
 
	var raildistances=[];
    raildistances.push(distances[x]);	
		var k3=(strUser)+(t1+1);
		
				for(var k=0;k<t;k++)
		
		{
	
		if(k==0){
			if(kcount==0){
			var m2=location1;
			
					weatherdetails(m2,m1,k,k1,t1,DrivePath,datevalue,t,address2,address1,location2,k2,checkdistances1,location1,new1,strUser,strUser3,distance3,distance8);
					
			}
			kcount++;
		}
		else{
if(strUser2==2 && address2=='Seattle, WA, United States' && address1=='Chicago, IL, United States'){
	marker2.setMap(null);
var p=(2788.9/(t-1));
	
}	 
if(strUser2==2 && address2=='Portland, OR, United States' && address1=='Chicago, IL, United States')
{
	marker2.setMap(null);
	var p=(2823.5/(t-1));
	
}
if(strUser2==2 && address2=='Spokane, WA, United States' && address1=='Chicago, IL, United States')
{
	marker2.setMap(null);
	
	var p=(2910/(t-1));
	
}
if(strUser2==2 && address1=='Seattle, WA, United States' && address2=='Chicago, IL, United States'){
var p=(2788.9/(t-1));
	
	marker1.setMap(null);
}	 
if(strUser2==2 && address1=='Portland, OR, United States' && address2=='Chicago, IL, United States')
{
	var p=(2823.5/(t-1));
	marker1.setMap(null);
	
}
if(strUser2==2 && address1=='Spokane, WA, United States' && address2=='Chicago, IL, United States')
{
	var p=(2910/(t-1));
	marker1.setMap(null);

}
if(strUser2==1 && address1=='Seattle, WA, United States' && address2=='Chicago, IL, United States'){
var p=(2788.9/(t-1));
	
}	 
if(strUser2==1 && address1=='Portland, OR, United States' && address2=='Chicago, IL, United States')
{
	var p=(2823.5/(t-1));
	
}
if(strUser2==1 && address1=='Spokane, WA, United States' && address2=='Chicago, IL, United States')
{
	var p=(2421.8/(t-1));

}
		if(p*k>d2 && p*k<distances[x])
		{
			
			if(strUser2==2)
			{
				if(address2=='Chicago, IL, United States'){
					if(address1=='Seattle, WA, United States'||address1=='Spokane, WA, United States'||address1=='Portland, OR, United States')
					{
						if(t==3||t==4){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
				 $('#info').hide();
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		 var start = address1;
  var end = address2;
  var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
 
						  if (p*(k-1)<(distance2-666.5) && p*(k)>(distance2-666.5)  && t!=3 && t!=6 && t!=10  && t!=4  && t!=8 && t!=5 && t!=7)
{
	
var LatLng6t = new google.maps.LatLng(39.114053, -94.6274636)
var m1=LatLng6t;

var marker18= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });

     DrivePath.push(m1);
}
else if (p*(k-1)<(distance2-1327.7) && p*(k)>(distance2-1327.7) && t!=6 && t!=8 && t!=4 && t!=7 && t!=10 )
{
	
var LatLng13 = new google.maps.LatLng( 39.7392358, -104.990251)
var m1=LatLng13;

var marker19= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
     DrivePath.push(m1);
}


else{
 
 if(t==4 && k==2){

	 var LatLng85 = new google.maps.LatLng(40.7607793,-111.8910474)
	 	var m1=LatLng85;
 }
 
 
	else{
		checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				  directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			}
			if(t==7){
				if(k<4){

						var m1=positions[x];
				}
			}
			else if(t==8){
				if(k!=5){

						var m1=positions[x];
				}
			}
			else{
					var m1=positions[x];
			}
	}

						var markerc= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
 counth++;
   DrivePath.push(m1);
}
if(t==6||t==5){
	
	
	var LatLng8 = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(t==7){
	
	var LatLng6b = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng6b,
      map: map,
	  
      title: 'Hello World!'
  });
	var LatLng8 = new google.maps.LatLng( 45.7965211,-119.3122389)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(t==8||t==9||t==10){
	
	
	var LatLng8 = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
  var LatLng6y = new google.maps.LatLng(45.7965211,-119.3122389)
  var marker11= new google.maps.Marker({
      position:LatLng6y,
      map: map,
	  
      title: 'Hello World!'
  });
  
}
if(address1=='Spokane, WA, United States')
{
	var LatLngd=new google.maps.LatLng(  47.6587802, -117.4260466)
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
	var flightPlanCoordinates1 = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	   {lat: 47.6587802, lng:  -117.4260466},
	  ];
	   var flightPath1= new google.maps.Polyline({
    path: flightPlanCoordinates1,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  flightPath1.setMap(map);
}
if(address1=='Seattle, WA, United States'){
	var LatLngd=new google.maps.LatLng( 47.6062095,-122.3320708)
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
						var flightPlanCoordinates = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816},
	{lat: 47.6062095, lng: -122.3320708}
   
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}
if(strUser2==2 && address1=='Portland, OR, United States')
{
	var LatLngd=new google.maps.LatLng(  45.5230622,-122.6764816)
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
	var flightPlanCoordinates2 = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816}
	
   
  ];
  var flightPath2 = new google.maps.Polyline({
    path: flightPlanCoordinates2,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath2.setMap(map);
	
}
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
 	
   }
			}
			else{
				if(v=='yes' )
		{
		
		
	checkdistances1.push(distances[x]);
		
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
				  
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  directionsDisplay.setMap(map);
				markerclear();
				 $('#info').hide();
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			
			else
		if(p*k>distances[x-1] && p*k<distances[x])
			{
			checkdistances1.push(distances[x]);
		
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606||distance2-checkdistances1[checkdistances1.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
				  
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  directionsDisplay.setMap(map);
				markerclear();
				 $('#info').hide();
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
   
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }


	
		}
			}
   debugger;
   } 
			
			else if(address1=='Chicago, IL, United States'){
							if(address2=='Seattle, WA, United States'||address2=='Spokane, WA, United States'||address2=='Portland, OR, United States')
					{
								if(t==3||t==4){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
				  $('#info').hide();
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
  
				  if (p*(k-1)<666.5 && p*(k)>666.5 && t!=3 && t!=6 && t!=10  && t!=4 && t!=7 && t!=8)
{
	
var LatLng12 = new google.maps.LatLng(39.114053, -94.6274636)
var m1=LatLng12;

var marker18= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
     DrivePath.push(m1);
}
 else if (p*(k-1)<1327.7 && p*(k)>1327.7 && t!=6 && t!=8 && t!=4 && t!=7 && t!=10 )
{
	
var LatLng13 = new google.maps.LatLng( 39.7392358, -104.990251)
var m1=LatLng13;

var marker19= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
     DrivePath.push(m1);
}


else{
 if(t==7 && k==4){

	 var LatLng76 = new google.maps.LatLng(40.7607793,-111.8910474)
	 	var m1=LatLng76;
 }
 else if(t==4 && k==2){

	 var LatLng76 = new google.maps.LatLng(40.7607793,-111.8910474)
	 	var m1=LatLng76;
 }
else if(t==8 && k==5){

	 var LatLng85 = new google.maps.LatLng(40.7607793,-111.8910474)
	 	var m1=LatLng85;
 }
  else if(t==9 && k==5){

	 
	 	var LatLng76 = new google.maps.LatLng(40.7607793,-111.8910474)
	 	var m1=LatLng76;
 }
	else{
						var m1=positions[x];
	}
						var markerc= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
 counth++;
   DrivePath.push(m1);
}
if(t==6||t==5){
	
	
	var LatLng8 = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(t==7){
	
	
	var LatLng8 = new google.maps.LatLng( 45.7965211,-119.3122389)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(t==9||t==10){
	
	
	var LatLng8 = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
  var LatLng6y = new google.maps.LatLng(45.7965211,-119.3122389)
  var marker11= new google.maps.Marker({
      position:LatLng6y,
      map: map,
	  
      title: 'Hello World!'
  });
  
}
if(t==8){
	 var LatLng6y = new google.maps.LatLng(45.7965211,-119.3122389)
  var marker11= new google.maps.Marker({
      position:LatLng6y,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(t==8 && address2=='Spokane, WA, United States'){
	var LatLng8 = new google.maps.LatLng(42.8713032, -112.4455344)


var marker11= new google.maps.Marker({
      position:LatLng8,
      map: map,
	  
      title: 'Hello World!'
  });
}
if(address2=='Spokane, WA, United States')
{
	var LatLngd=new google.maps.LatLng(  47.6587802, -117.4260466)
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
	var flightPlanCoordinates1 = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	   {lat: 47.6587802, lng:  -117.4260466},
	  ];
	   var flightPath1= new google.maps.Polyline({
    path: flightPlanCoordinates1,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  flightPath1.setMap(map);
}
if(address2=='Seattle, WA, United States'){
	var LatLngd=new google.maps.LatLng( 47.6062095,-122.3320708)
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
						var flightPlanCoordinates = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816},
	{lat: 47.6062095, lng: -122.3320708}
   
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}
if(strUser2==2 && address2=='Portland, OR, United States')
{
	var LatLngd=new google.maps.LatLng(  45.5230622, -122.6764816);
	var markerc4= new google.maps.Marker({
      position:LatLngd,
      map: map,
	  
      title: 'Hello World!'
  });
  markerc4.setMap(map);
	var flightPlanCoordinates2 = [
   {lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816}
	
   
  ];
  var flightPath2 = new google.maps.Polyline({
    path: flightPlanCoordinates2,
    geodesic: true,
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath2.setMap(map);
	
}
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

 
  }
  if(t==3){
	 var Flight = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  }); 
  }
				}
				else{
					if(v=='yes')
		{
			checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
  $('#info').hide();
				markerclear();
				
			}
			else{
				  $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 	 directionsDisplay.setMap(map);
				markerclear();
			
			}
			else{
				 $('#info').show();
			}
				 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x] && strUser2==2)
			{
				checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
  $('#info').hide();
				markerclear();
				
			}
			else{
				  $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 	 directionsDisplay.setMap(map);
				markerclear();
			
			}
			else{
				 $('#info').show();
			}
				 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
				}
			}
			else if(address2!='Chicago, IL, United States' ){
	if(address1=='Portland, OR, United States'||address1=='Spokane, WA, United States'||address1=='Seattle, WA, United States' ){
if(v=='yes')
		{
		
			checkdistances1.push(distances[x]);
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	   waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
				 $('#info').hide();
				markerclear4();
				
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				   var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	  waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
 $('#info').hide();
				markerclear4();
		
			}
			else{
				 $('#info').show();
			}
			 function markerclear4(){
	   for(var r=0;r<t-1;r++){
		   Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);
		  
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x])
			{
				checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
				 $('#info').hide();
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				   var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
 $('#info').hide();
				markerclear();
		
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
}
else if(address2=='Portland, OR, United States'||address2=='Spokane, WA, United States'||address2=='Seattle, WA, United States' ){
if(v=='yes')
		{
		
				checkdistances1.push(distances[x]);
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	  waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
$('#info').hide();
				markerclear5();
 
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	  waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
	  $('#info').hide();
				markerclear5();
			
			}
			else{
				 $('#info').show();
			}
			 function markerclear5(){
	   for(var r=0;r<t-1;r++){
		    Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x])
			{
				checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
$('#info').hide();
				markerclear();
 
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
	  $('#info').hide();
				markerclear();
			
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
}
else{
if(v=='yes')
		{
		
		
				checkdistances1.push(distances[x]);
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
			 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	  waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
 $('#info').hide();
				markerclear6();
				 
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
	  waypoints:waypts,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
$('#info').hide();
				markerclear6();
				  
			}
			else{
				 $('#info').show();
			}
			 function markerclear6(){
	   for(var r=0;r<t-1;r++){
		    Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x])
			{
				checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
			 var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
 $('#info').hide();
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  var start = address1;
  var end = address2;
				var request = {
      origin: start,
      destination: end,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
   directionsService.route(request, function(response, status) 
		{
			if (status == google.maps.DirectionsStatus.OK) 
			{
				directionsDisplay.setDirections(response);
		
			
		
			
			
				 directionsDisplay.setMap(map);
			
				
			}
			
});
$('#info').hide();
				markerclear();
				  
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}	
	
		
}
}
		
			}
			
		else if(strUser2==1 ){
				 if(address1=='Chicago, IL, United States'  ) {
					if(address2=='Portland, OR, United States'||address2=='Seattle, WA, United States'){
						if(t==3){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				$('#info').hide();
				 directionsDisplay.setMap(map);
				markerclear();
				  
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }

				  if (p*(k-1)<525.4 && p*(k)>525.4 && t!=3 && t!=7 && t!=4)
{
	
var LatLng = new google.maps.LatLng(45.047429, -93.26862740000001)
var m1=LatLng;

var marker11= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}


else if(p*(k-1)<916.4 && p*(k)>916.4 && t!=5 && t!=3){
	
	var LatLng3 = new google.maps.LatLng(46.8604745, -96.829672)
var m1=LatLng3;
 var marker13= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
  
else if(p*(k-1)<1320.1 && p*(k)>1320.1 && t!=4 && t!=7){

	var LatLng4 = new google.maps.LatLng(48.1469683,-103.6179745)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
else if(p*(k-1)<1953.4&& p*(k)>1953.4 && t!=8 && t!=7){

	var LatLng4 = new google.maps.LatLng(48.4135715,-114.3357669)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
else{




	var m1=positions[x];
	
var marker12= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
 DrivePath.push(m1);
}

if(t>2){
directionsDisplay.setMap(null);
}
if(t==3){
	var Flight2 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
 var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
			}
				}
				else if(address2=='Spokane, WA, United States' ){
						if(t==3){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
					 directionsDisplay.setMap(null);
				  if (p*(k-1)<475.4 && p*(k)>475.4 && t!=3 && t!=7 && t!=4)
{
	
var LatLng = new google.maps.LatLng(45.047429, -93.26862740000001)
var m1=LatLng;

var marker11= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}


else if(p*(k-1)<876.4 && p*(k)>876.4 && t!=7 && t!=3 && t!=4 && t!=5){
	
	var LatLng3 = new google.maps.LatLng(46.8604745, -96.829672)
var m1=LatLng3;
 var marker13= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
  
else if(p*(k-1)<1320.1 && p*(k)>1320.1 && t!=4 && t!=5 && t!=7){

	var LatLng4 = new google.maps.LatLng(48.1469683,-103.6179745)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
else if(p*(k-1)<1953.4&& p*(k)>1953.4){

	var LatLng4 = new google.maps.LatLng(48.4135715,-114.3357669)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   DrivePath.push(m1);
}
else{




	var m1=positions[x];
	
var marker12= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
 DrivePath.push(m1);
}

if(t>2){
directionsDisplay.setMap(null);
}
if(t==3){
	var Flight2 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
 var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
			}
			
				}
				else{
			
						if(v=='yes' )
		{
		
		checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				   directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);
		   
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	 
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x] )
			{
			checkdistances.push(distances[x]);
            for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				   directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }


	
		}
					
				}
				
				}
					
			
			else if(address2=='Chicago, IL, United States' && address1=='Seattle, WA, United States'){
					if(t==3||t==4){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
					 if(p*(k-1)<601.3&& p*(k)>601.3 && t!=6 && t!=3 && t!=4 && t!=7 && t!=8){

	var LatLng4 = new google.maps.LatLng(48.4135715,-114.3357669)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
  
}
else if(p*(k-1)<1360.2 && p*(k)>1360.2 && t!=7){

	var LatLng5 = new google.maps.LatLng(48.1469683,-103.6179745)
var m1=LatLng5;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}
else if(p*(k-1)<1918.6 && p*(k)>1918.6 && t!=7){
	
	var LatLng3 = new google.maps.LatLng(46.8604745, -96.829672)
var m1=LatLng3;
 var marker13= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}
  
					
				else  if (p*(k-1)<2237.6 && p*(k)>2237.6 && t!=7)
{
	
var LatLng = new google.maps.LatLng(45.047429, -93.26862740000001)
var m1=LatLng;

var marker11= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}




else{


	

		var m1=positions[x];
	
	
var marker6= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });

DrivePath.push(m1);

countp++;

 if(t==9 && k==5){
	marker6.setMap(null);
}
else if(t==10 && k==6){
	marker6.setMap(null);
}
}

if(t>2){
directionsDisplay.setMap(null);

}

var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];

if(t==3){
	var Flight2 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
for (var i = 0; i < DrivePath.length-1; i++) {
	
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}
			}
			else if(address2=='Chicago, IL, United States' && address1=='Spokane, WA, United States' ){
					if(t==3){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
				  if (p*(k-1)<1870.1 && p*(k)>1870.1 && t!=9)
{
	
var LatLng = new google.maps.LatLng(45.047429, -93.26862740000001)
var m1=LatLng;

var marker11= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}


 else if(p*(k-1)<1552.3 && p*(k)>1552.3 && t!=9){
	
	var LatLng3 = new google.maps.LatLng(46.8604745, -96.829672)
var m1=LatLng3;
 var marker13= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}
  
else if(p*(k-1)<955.3 && p*(k)>955.3 && t!=9){

	var LatLng4 = new google.maps.LatLng(48.1469683,-103.6179745)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}

else if(p*(k-1)<244.5 && p*(k)>244.5 && t!=5 && t!=4 && t!=6){

	var LatLng4 = new google.maps.LatLng(48.4135715,-114.3357669)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  DrivePath.push(m1);
}
else{




	var m1=positions[x];
	
var marker12= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
DrivePath.push(m1);
}

if(t>2){
directionsDisplay.setMap(null);
}
if(t==3){
	var Flight2 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
 var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];

for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
			}
		else if(address2=='Chicago, IL, United States' && address1=='Portland, OR, United States' ){
			 	if(t==3||t==4){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			
				if(p*(k-1)<609.2 && p*(k)>609.2 && t!=3 && t!=6){

	var LatLng5 = new google.maps.LatLng(48.4135715,-114.3357669)
var m1=LatLng5;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
 
  DrivePath.push(m1);
  
}

else if(p*(k-1)<1409.3 && p*(k)>1409.3  && t!=5 && t!=6){

	var LatLng4 = new google.maps.LatLng(48.1469683,-103.6179745)
var m1=LatLng4;
 var marker14= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
  DrivePath.push(m1);
}	

else if(p*(k-1)<1988.9 && p*(k)>1988.9 && t!=10 && t!=7 ){
	
	var LatLng3 = new google.maps.LatLng(46.8604745, -96.829672)
var m1=LatLng3;
 var marker13= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });

  DrivePath.push(m1);
}
  

			else if (p*(k-1)<2289.7 && p*(k)>2289.7 && t!=10)
{
	
var LatLng = new google.maps.LatLng(45.047429, -93.26862740000001)
var m1=LatLng;

var marker11= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });

  DrivePath.push(m1);
}




else{




	var m1=positions[x];
	
var marker12= new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
   
DrivePath.push(m1);
}

if(t>2){
directionsDisplay.setMap(null);
}
 var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
			}
		
else if(address2=='Chicago, IL, United States'){
	if(address1!='Portland, OR, United States' && address1!='Spokane, WA, United States' && address1!='Seattle, WA, United States' ){
if(v=='yes' )
		{
		checkdistances.push(distances[x]);
 for(var i=0;i<checkdistances.length;i++)
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				  directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x])
			{
					if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				  directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
}
}
else if(address2!='Chicago, IL, United States' ){
	if(address1=='Portland, OR, United States'||address1=='Spokane, WA, United States'||address1=='Seattle, WA, United States' ){
if(v=='yes')
		{
		
			checkdistances1.push(distances[x]);
			
					if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				 $('#info').hide();
				 
			   directionsDisplay.setMap(map);
					markerclear3();
				 
				
			}
			else{
				 $('#info').show();
			}
			
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				directionsDisplay.setMap(map);
				  $('#info').hide();
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear3(){
	   for(var r=0;r<t-1;r++){
		   	Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);

		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else if(p*k>distances[x-1] && p*k<distances[x])
			{
			checkdistances.push(distances[x]);
			
					if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				 directionsDisplay.setMap(map);
				 $('#info').hide();
				
				 
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				directionsDisplay.setMap(map);
				  $('#info').hide();
				markerclear();
				 
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
}
else if(address2=='Portland, OR, United States'||address2=='Spokane, WA, United States'||address2=='Seattle, WA, United States' ){
if(v=='yes')
		{
			checkdistances1.push(distances[x]);
 if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				
				 directionsDisplay.setMap(map);
				 markerclear();
			}
			else{
				 $('#info').show();
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 	 directionsDisplay.setMap(map);
				markerclear();
			
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		 
			Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
		   directionsDisplay.setMap(map);
		   
		
	   }
	   				 directionsDisplay.setMap(map);
   }
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x] )
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
				 	 directionsDisplay.setMap(map);
				markerclear();
			
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null);
		 
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}


}
else{
	if(v=='yes')
		{
		checkdistances1.push(distances[x]);
		if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				 
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				   directionsDisplay.setMap(map);
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		map.clear();
		Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);

		   directionsDisplay.setMap(map);
		   
		
	   }
	   				 directionsDisplay.setMap(map);
   }
	
	
 
   if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-3) && t>4){
	 var LatLng2 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng2;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
}
else if(distance3>p*(t-2) && distance3<p*t && k==(t-2))
{

 var LatLng1 = new google.maps.LatLng(41.850033, -87.6500523)
 var m1=LatLng1;
 var marker7 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 }


 
  
else{




	var m1=positions[x];
	


}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


	 debugger;		
			}
			else
		if(p*k>distances[x-1] && p*k<distances[x] && v!='yes')
			{
			if((checkdistances[i+1]-checkdistances[i])>965.606||distance2-checkdistances[checkdistances.length-1]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				 $('#info').hide();
				 directionsDisplay.setMap(map);
				 
				markerclear();
				
			}
			else{
				 $('#info').show();
			}
			if(t==3 && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				  $('#info').hide();
				markerclear();
				 directionsDisplay.setMap(map);
			}
			else{
				 $('#info').show();
			}
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1==1){
var Flight9 = new google.maps.Polyline({
    path: [location1,loaction2 ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1-1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }
	}
}
}

		}
	
	else if(strUser2==0){
		
		if(v=='yes' )
		{
						
		checkdistances1.push(distances[x]);
			
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
		
				 
			
				 $('#info').hide();
                                     $('#info5').hide();
				markerclear2();
				 directionsDisplay.setMap(map);
				  
			}
			else{
                 
				 $('#info').show();
                                    $('#info5').show();
			}
			}
				
			 if(t==3  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
			 $('#info').hide();
                                     $('#info5').hide();
				markerclear2();
				 directionsDisplay.setMap(map);
				  
				
				  
				 
			}
			else{
				 $('#info').show();
                                         $('#info5').show();
			}
		
  
	
 if (p*(k-1)<distance3 && p*(k+1)>distance3)
{
	
var LatLng = new google.maps.LatLng(41.850033, -87.6500523)
var m1=LatLng;
if(t1==3 && distance3>p*(t1-2))  {
	var Flight12 = new google.maps.Polyline({
    path: [m1,location2],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}


if(k==t-2 && t!=3){
					
			if((distance8)>965.606){
					
				alert("error: not enough transit time to cover full route (please add more days)");
		
				 
			
			
				markerclear3();
				 directionsDisplay.setMap(map);
					
			}
				}
 }


 
  
else{




	var m1=positions[x];
	

	
}



var marker6 = new google.maps.Marker({
      position:m1,
      map: map,
	  
      title: 'Hello World!'
  });
  markersArray.push(marker6);
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
 DrivePath.push(m1);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: '#008000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
lines.push(Flight);
lines.push(PathStyle);
}

 if (!(p*(t-1)<distance3 && p*t>distance3) ){
if(t1>2 &&   DrivePath.length==(t1-1)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  }
if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {
   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   Flight2.setMap(null);
   		
   }
   }
 if(t==3){
var Flight5 = new google.maps.Polyline({
    path: [location1,m1 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

 function markerclear3(){
	 	 marker1.setMap(null);
	marker2.setMap(null);
	  $('#info').hide();
                                     $('#info5').hide();
clearOverlays(); 
		     directionsDisplay.setMap(map);

 
		 
		  
	   
	
	   				 directionsDisplay.setMap(map);
   }	
   function clearOverlays() {
	   for ( var j=0; j<lines.length; j++) 
{                           
  lines[j].setMap(null); //or line[i].setVisible(false);
}
lines.length = 0;
  for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
	 
  }

  markersArray.length = 0;
   directionsDisplay.setMap(map);
    
	 
  


      
   Flight12.setMap(null);
}
		 function markerclear2(){
	   for(var r=0;r<t;r++){
if(t!=3){
marker6.setMap(null);
}
marker1.setMap(null);
marker2.setMap(null);
		     directionsDisplay.setMap(map);
Flight12.setMap(null);
Flight3.setMap(null);
Flight2.setMap(null);
 
		 
		  
	   }
	
	   				 directionsDisplay.setMap(map);
   }	
	 debugger;		
			}
			
		else
		if(p*k>distances[x-1] && p*k<distances[x] && strUser2==0)
			{
			checkdistances1.push(distances[x]);
			
            for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				
				 $('#info').hide();
                                $('#info5').hide();
				markerclear();
				 directionsDisplay.setMap(map);
				  
			}
			else{
				 $('#info').show();
                                  $('#info5').show();
			}
			}
			if(t==2  && distances[x]>965.606){
				alert("error: not enough transit time to cover full route (please add more days)");
				
				
				 $('#info').hide();
                              $('#info5').hide();
				  directionsDisplay.setMap(map);
				markerclear();
				 
				
			}
			else{
				 $('#info').show();
                              $('#info5').show();
			}
			
			 function markerclear(){
	   for(var r=0;r<t-1;r++){
marker1.setMap(null);
marker2.setMap(null);
		   marker5.setMap(null)
		   directionsDisplay.setMap(map);
		   map.clear();
		
	   }
	   				 directionsDisplay.setMap(map);
   }
   
			var m1=positions[x];

	var marker5 = new google.maps.Marker({
      position:m1,
      map: map,
      title: 'Hello World!'
  });
  if(t==2){
	  directionsDisplay.setMap(null);
  }
var Colors = [
   "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900", 
    "#009900"
];
   
  DrivePath.push(positions[x-1]);
for (var i = 0; i < DrivePath.length-1; i++) {
var Flight = new google.maps.Polyline({
    path: [location1,DrivePath[0] ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: Colors[i],
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}

if(t==2){
var Flight5 = new google.maps.Polyline({
    path: [location1,positions[x-1] ],
    strokeColor: '#778899',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  var Flight6 = new google.maps.Polyline({
    path: [positions[x-1],location2 ],
    strokeColor: '#9370DB',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
}
if(t1>6 &&  DrivePath.length==(t1-2)){
var Flight2 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1] ],
    strokeColor: '#8B0000',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });

   
   }

   if(t1<10 && t1>2 &&  DrivePath.length==(t1))
   {

   var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: "#009900",
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
   
   
   }


	
		}
		
		}







	

	
	
	

var newdate=(strUser);
var datevalue=(strUser);
var k1=(k+newdate);
if(strUser2==2){
	if(address2=='Chicago, IL, United States')
	{
		
		if(address1=='Portland, OR, United States')
		{
		
		 updetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
		  
	}
	else if(address1=='Spokane, WA, United States')
		{
		
		 updetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
		  
	}
else if(address1=='Seattle, WA, United States')
		{
	
		updetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
		  
	}
	else{
			upweatherdetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
	}
	}
else if(address1=='Chicago, IL, United States')
	{
if( address2=='Portland, OR, United States'||address2=='Spokane, WA, United States'||address2=='Seattle, WA, United States'){
	if(k==5 ){
		if(placecounter==0){
		 updetails2(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
		}
		placecounter++;
	}
	else{
		updetails2(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
	}
	}
	else{
		upweatherdetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1);
	}
	}
	else{
	upweatherdetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1)
	}	
		
	}
	
	
		if(k==1){
		if(counter<1){
		Geocode(m1,k,k1,datevalue,t1,t,address2,address1,checkdistances1);
		}
		else{
		
		marker6.setMap(null);
		
		}
		counter++;
		}
		if(k==2){
		if(count<1){
		Geocode(m1,k,k1,datevalue,t1,t,address2,address1,checkdistances1);
		}
		else{
		
		marker6.setMap(null);
		}
		count++;
		}
		if(k>2 && k<8)
		{
			Geocode(m1,k,k1,datevalue,t1,t,address2,address1,checkdistances1);
		}
		
			if(k==8){
				
			if(count1<1){
		Geocode(m1,k,k1,datevalue,t1,t,address2,address1,checkdistances1);
			
			
				
				
		}
		else{
			
			marker6.setMap(null);
		}
		count1++;
		}
		
	
	}
	
		}
			}
			}
	
		
				var k2=(datevalue)+(t1+1);

			function Geocode(m1,k,k1,datevalue,t1,t,address2,address1,checkdistances1) {
					
    

   
var k2=(datevalue)+(t1+1);
	

	
		if(strUser2==0){
			
			weatherdetails(m2,m1,k,k1,t1,DrivePath,datevalue,t,address2,address1,location2,k2,checkdistances1,location1,new1,strUser,strUser3,distance3,distance8);
     
		}
		if(strUser2==1){
weatherdetails(m2,m1,k,k1,t1,DrivePath,datevalue,t,address2,address1,location2,k2,checkdistances1,location1,new1);
		}
	
	
		
	
        }

		if(t>1)
		{
			if(strUser2==2){
			if(address1=='Chicago, IL, United States' && address2=='Portland, OR, United States'||address1=='Chicago, IL, United States' && address2=='Seattle, WA, United States'||address1=='Chicago, IL, United States' && address2=='Spokane, WA, United States'){
				if(address2=='Portland, OR, United States'){
					if(t==3){
							 enddetails10(k2,t,m1,DrivePath,address2)
					}
					if(t==4){
							 enddetails9(k2,t,DrivePath,address2)
					}
				if(t>4 && t<7){
						 enddetails8(k2,t,m1,DrivePath,address2)
				}
					if(t>6)
					{
						var LatLnga = new google.maps.LatLng(45.7965211,-119.3122389);
						var location4=LatLnga; 
						var LatLngb = new google.maps.LatLng( 45.5230622,-122.6764816)
						var location5=LatLngb ;
						 enddetails2(location4,location5,k2,t,DrivePath,address2)
					}
				}
				if(address2=='Seattle, WA, United States'){
					if(t==3){
							 enddetails7(k2,t,m1,DrivePath,address2)
					}
					if(t==4){
							 enddetails6(k2,t,DrivePath,address2)
					}
						if(t>4 && t<7){
						var LatLnga = new google.maps.LatLng(45.7965211,-119.3122389);
						var location4=LatLnga;
						var LatLngb = new google.maps.LatLng(47.6062095,-122.3320708);
						var location5=LatLngb;
						var LatLngc = new google.maps.LatLng(45.5230622,-122.6764816);
						var location6=LatLngc;
							 enddetails5(location4,location5,location6,k2,t,DrivePath,address2)
					}
					if(t>6)
					{
						var LatLnga = new google.maps.LatLng(45.7965211,-119.3122389);
						var location4=LatLnga;
						var LatLngb = new google.maps.LatLng(47.6062095,-122.3320708);
						var location5=LatLngb;
						var LatLngc = new google.maps.LatLng(45.5230622,-122.6764816);
						var location6=LatLngc;
						
						 enddetails4(location4,location5,location6,k2,t,DrivePath,address2)
					}
				}
				if(address2=='Spokane, WA, United States'){
						if(t==3){
							 enddetails13(k2,t,m1,DrivePath,address2)
					}
					if(t==4){
							 enddetails12(k2,t,DrivePath,address2)
					}
				if(t>4 && t<7){
						 enddetails11(k2,t,m1,DrivePath,address2)
				}
					if(t>6)
					{
						var LatLnga = new google.maps.LatLng(45.7965211,-119.3122389);
						var location4=LatLnga 
						var LatLngb = new google.maps.LatLng( 47.6587802,-117.4260466)
						var location5=LatLngb;
						 enddetails2(location4,location5,k2,t,DrivePath,address2)
					}
				}
			}
			
			
		else if( address2=='Chicago, IL, United States')
		{
			if(address1=='Seattle, WA, United States'||address2=='Chicago, IL, United States' && address1=='Portland, OR, United States'||address2=='Chicago, IL, United States' && address1=='Spokane, WA, United States')
			{
				
     
		  if(address1=='Seattle, WA, United States'){
       var location3=new google.maps.LatLng(41.850033,-87.6500523);
        enddetails3(location3,k2,t,DrivePath,address2)
		  }
		  if(address1=='Portland, OR, United States'){
       var location3=new google.maps.LatLng( 41.850033,-87.6500523)
        enddetails3(location3,k2,t,DrivePath,address2)
		  }
		  if(address1=='Spokane, WA, United States'){
       var location3=new google.maps.LatLng( 41.850033,-87.6500523);
        enddetails3(location3,k2,t,DrivePath,address2)
		  
      } 
  
		}
		
			}
			else{
				enddetails(strUser2,location2,k2,t,DrivePath);
			}
		}
			
				
				if(strUser2==2 && address2=='Chicago, IL, United States'){
	if(address1!='Portland, OR, United States' && address1!='Spokane, WA, United States' && address1!='Seattle, WA, United States' ){
				enddetails(strUser2,location2,k2,t,DrivePath)
				}}
			
		}	    
			}
			
		function toRad(deg) 
	{
		return deg * Math.PI/180;
	}

	
	
	
function attachInstructionText(marker, text) {
  google.maps.event.addListener(marker, 'click', function() {
    // Open an info window when the marker is clicked on,
    // containing the text of the step.
    stepDisplay.setContent(text);
    stepDisplay.open(map, marker);
  });
}
var num=[];
var num1=[];
var num3=[];
var num4=[];
var sequence=[];
var sequence1=[];
   function startdetails2(address1,new1)
   {
	 
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address1+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c', function (data) {
                     console.log(data);
    
"<table>"
   $( "#info" ).prepend("<br/>"+"Day1 :"+"   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"      "+Math.round(((data.list[new1+1].temp.max-273.15)*9/5)+32)+"   /    "+"Low"+"     "+Math.round(((data.list[new1+1].temp.min-273.15)*9/5)+32)+"</br>");
 "</table>"
                 }); 
   $('#loading-indicator').hide();
   }
   function middetails(k)
   {

        $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?lat=41.850033&lon=-87.6500523&cnt=10&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c', function (data) {
                     console.log(data);


  

$("#info").append("Day :"+k+"                   "+data.city.name+"High"+"          "+(((data.list[k-1].temp.max-273.15)*9/5)+32)+"       "+"Low"+"         "+(((data.list[k-1].temp.min-273.15)*9/5)+32)+"</br>");

 



                 }); 
  
   }
   var countera=0;
   function updetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1)
{
	   if(t==10 && countera==0){
	 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+3+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[3].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[3].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
}
 if(t==9 && countera==0){
	 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+3+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[3].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[3].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
}
if(t==8 && countera==0){
	 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=6&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+3+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[3+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[3+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
}
if(t==7 && countera==0){
	 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+3+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[3+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[3+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
}
if(t==6 && countera==0 ){
	 
			
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 
			
}
if(t==5 && countera==0){
	 
			
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+2+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[2+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[2+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
}


	  setTimeout(function() {
$('#loading-indicator').hide();
       $.ajax({
       
    url :'http://api.openweathermap.org/data/2.5/forecast/daily?lat='+m1.lat()+'&lon='+m1.lng()+'&cnt=9&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',
    crossDomain: true,
  async:false,
  success:callback,
   
                     error: function (xhr, textStatus, errorThrown) {
                         console.log('Error in Operation');
					 console.log(textStatus);
                     },

             
    
 
        
 
  
  


                    
     
      
                 });
},500);
				 function callback(data){
 
 
	if(t<6){
	$("#info").append("Day"+(k+2)+":"+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+Math.round(((data.list[k1+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+2].temp.min-273.15)*9/5)+32));
	}
else if(t==6){
			$("#info").append("Day"+(k+2)+":"+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+Math.round(((data.list[k1+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+2].temp.min-273.15)*9/5)+32));

	}
	else{
		if(k<t-3 && t!=6){
$("#info").append("Day"+(k+3)+":"+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+Math.round(((data.list[k1+3].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+3].temp.min-273.15)*9/5)+32));

	}
	
	}
	
if(t<6){
var temp1=Math.round(((data.list[k1+2].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+2].temp.min-273.15)*9/5)+32);
}
else{
		if(k<t-3){
		var temp1=Math.round(((data.list[k1+3].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+3].temp.min-273.15)*9/5)+32);	
			
		}
}

	if(temp1>90 && temp1<95)
{

num.push(k);

var h2=0;
if(num[h2+1]-num[h2]==1)
{


 
 $('#info').append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');
 for (var i = 0; i < DrivePath.length-1; i++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: '#fff000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }
 
 
 $('#warnings').show();
$('#yellow').show();
;
}


else{
$('#yellow').hide();

}
}

if(temp1<90 && temp2<80)
{

num1.push(k);

var h1=0;

if(num1[h1+1]-num1[h1]==1)
{


 
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>')
 
 for (var f = 0; f < DrivePath.length-1; f++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[f], DrivePath[f+1]],
    strokeColor: '#FF0000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }

  $('#red').show();
  $('#warnings').show();
}
else{
  $('#red').hide();

 }



}
}
  


countera++;
   }
    
   function upweatherdetails(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1)
{



       $.ajax({
       
   url :'http://api.openweathermap.org/data/2.5/forecast/daily?lat='+m1.lat()+'&lon='+m1.lng()+'&cnt=10&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',
    crossDomain: true,
  async:false,
  success:callback,
   
                     error: function (xhr, textStatus, errorThrown) {
                         console.log('Error in Operation');
					 console.log(textStatus);
                     },

             
    
 
        
 
  
  


                    
     
      
                 });
				 function callback(data){


	
	$("#info").append("Day"+(k+1)+":"+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+Math.round(((data.list[k1+1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+1].temp.min-273.15)*9/5)+32));
	



var temp1=Math.round(((data.list[k1+1].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+1].temp.min-273.15)*9/5)+32);
	if(temp1>90 && temp1<95)
{

num.push(k);

var h2=0;
if(num[h2+1]-num[h2]==1)
{


 
 $('#info').append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');
 for (var i = 0; i < DrivePath.length-1; i++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: '#fff000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }
 
 
 $('#warnings').show();
$('#yellow').show();
;
}


else{
$('#yellow').hide();

}
}

if(temp1<90 && temp2<80)
{

num1.push(k);

var h1=0;

if(num1[h1+1]-num1[h1]==1)
{


 
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>')
 
 for (var f = 0; f < DrivePath.length-1; f++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[f], DrivePath[f+1]],
    strokeColor: '#FF0000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }

  $('#red').show();
  $('#warnings').show();
}
else{
  $('#red').hide();

 }



}
	


  
}
}
   var counter10=0;
   var counter9=0;
   var counter7=0;
function updetails2(m1,k,k1,t1,DrivePath,datevalue,t1,t,address2,address1)
{

if(k<8)
{

       $.ajax({
       
   url :'http://api.openweathermap.org/data/2.5/forecast/daily?lat='+m1.lat()+'&lon='+m1.lng()+'&cnt=10&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',
    crossDomain: true,
  async:false,
  success:callback,
   
                     error: function (xhr, textStatus, errorThrown) {
                         console.log('Error in Operation');
					 console.log(textStatus);
                     },

             
    
 
        
 
  
  


                    
     
      
                 });
				 function callback(data){


	
	$("#info").append("Day"+(k+1)+":"+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+Math.round(((data.list[k1+1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+1].temp.min-273.15)*9/5)+32));
	



var temp1=Math.round(((data.list[k1+1].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+1].temp.min-273.15)*9/5)+32);
	if(temp1>90 && temp1<95)
{

num.push(k);

var h2=0;
if(num[h2+1]-num[h2]==1)
{


 
 $('#info').append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');
 for (var i = 0; i < DrivePath.length-1; i++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[i], DrivePath[i+1]],
    strokeColor: '#fff000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }
 
 
 $('#warnings').show();
$('#yellow').show();
;
}


else{
$('#yellow').hide();

}
}

if(temp1<90 && temp2<80)
{

num1.push(k);

var h1=0;

if(num1[h1+1]-num1[h1]==1)
{


 
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>')
 
 for (var f = 0; f < DrivePath.length-1; f++) {
 
 var PathStyle = new google.maps.Polyline({
    path: [DrivePath[f], DrivePath[f+1]],
    strokeColor: '#FF0000' ,
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
 
 
 }

  $('#red').show();
  $('#warnings').show();
}
else{
  $('#red').hide();

 }



}
	


  
}



if(strUser2==2 && counter7==0 && address2=='Spokane, WA, United States'){
	if(t==5){
		
		 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+4+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[4+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[4+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
	}
	if(t==6)
	{
		 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+5+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[5+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[5+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
	if(t==7)
	{
		 
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+6+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[6+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[6+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==8)
	{
		$.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+6+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[6+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[6+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
  
	}
		if(t==9)
	{
		$.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
  
	}
	if(t==10)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+9+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[9].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[9].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
    
	}
	counter7++;
}
if(strUser2==2 && counter10==0 && address2=='Portland, OR, United States'){
		if(t==5)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+4+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[4+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[4+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==6)
	{
			$.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+5+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[5+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[5+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
	if(t==7)
	{ 
$.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+6+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[6+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[6+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });

	}
	if(t==8)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==9)
	{
			
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
  
	}
	if(t==10)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=15&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+9+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[9].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[9].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
    
	}
	 counter10++;
	
}
if(strUser2==2 && counter9==0 && address2=='Seattle, WA, United States'){

	if(t==5)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+4+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[4+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[4+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==6)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+5+"   :     "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[5+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[5+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==7)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+6+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[6+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[6+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
			if(t==8)
	{
		
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+"Hinkle"+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7+datevalue].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7+datevalue].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			

	}
		if(t==9)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+7+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[7].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[7].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });

	}
	if(t==10)
	{
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Pocatello,ID,USA&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+8+"   :     "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[8].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[8].temp.min-273.15)*9/5)+32)+'<br>' );

			 });
			 $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q=Hinkle,OR&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',function (data){
				 $("#info").append( "Day"+9+"   :     "+"Hinkle"+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"            "+Math.round(((data.list[9].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[9].temp.min-273.15)*9/5)+32)+'<br>' );

			 });

	}
	counter9++;
  
      
}          
	
}
}
function enddetails(k3,t,m1,location2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?lat='+location2.lat()+'&lon='+location2.lng()+'&cnt=5&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
					 
      if(k3==2){
						       $( "#info" ).append("Day"+(k3+2)+" :   "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k3-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32)+"</br>");
                      var temp=  Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32);
					 }
					 if(k3==3){
						       $( "#info" ).append("Day"+(k3+2)+" :   "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k3-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32)+"</br>");
                          var temp=  Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32);
					 }
					 if(k3==4){
						       $( "#info" ).append("Day"+(k3+2)+" :   "+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k3-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32)+"</br>");
                            var temp=  Math.round(((data.list[k3-1].temp.min-273.15)*9/5)+32);
					 }
     test(temp);
	 },200)});
	   function test(temp)
  {
 if(temp<20)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	
}
   }
var weathercounter1=0;
var weathercounter=0;
var result=[];
var wcount=0;
var result1=[];
var array1=[];
var y=[];
var tempmax=[];
var tempmin=[];
function weatherdetails(m2,m1,k,k1,t1,DrivePath,datevalue,t,address2,address1,location2,k2,checkdistances1,location1,new1,strUser,strUser3,distance3,distance8)
{
	
	if(k==0){
			
		$.ajax({
       
   url :'http://api.openweathermap.org/data/2.5/forecast/daily?lat='+m2.lat()+'&lon='+m2.lng()+'&cnt=10&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',
    crossDomain: true,
  async:false,
  success:callback,
   
                     error: function (xhr, textStatus, errorThrown) {
                         console.log('Error in Operation');
					 console.log(textStatus);
                     },

             
    
 
        
 
  
  


                    
     
      
                 });
	}
		else{
		$.ajax({
       
   url :'http://api.openweathermap.org/data/2.5/forecast/daily?lat='+m1.lat()+'&lon='+m1.lng()+'&cnt=14&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',
    crossDomain: true,
  async:false,
  success:callback,
   
                     error: function (xhr, textStatus, errorThrown) {
                         console.log('Error in Operation');
					 console.log(textStatus);
                     },

             
    
 
        
 
  
  


                    
     
      
                 });
		}

				 function callback(data){
					
$('#loading-indicator').hide();
if(k==0){
	if(wcount==0){
	var datevalue=k+strUser3;
	if(strUser==0){
				for(var j=0;j<2;j++){
					if(j==1){
								$("#info").append("Day"+(k+j)+"                                    "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));
tempmax.push(Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32));
tempmin.push(Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));
function weather(tempmax,tempmin){
	for(var u=0;u<tempmax.length;u++){
			if(tempmax[u]<10 && tempmin[u]<0){
				num3.push(u);
			}
			
		}

		for(var d=0;d<num3.length+1;d++){

			
	 if(num3[d+2]-num3[d]==2){
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>');
  	 $('#red').show();
  $('#warnings').show();
	 
			
		}
	}
	for(var a=0;a<tempmax.length;a++){
				if(tempmax[a]<32){
				num4.push(a);
			}
					}
					
		for(var n=0;n<num4.length;n++){
			if(num4[n+1]-num4[n]==1){
	 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');

  	 $('#yellow').show();
  $('#warnings').show();
	 
			}
		}
			}
		
weather(tempmax,tempmin);
				}
				}
		

			}
			if(strUser==1){
				for(var j=1;j<3;j++){
								$("#info").append("Day"+(k+j)+"                                     "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));

								tempmax.push(Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32));
                                 tempmin.push(Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));
						function weather(tempmax,tempmin){
	for(var u=0;u<tempmax.length;u++){
			if(tempmax[u]<10 && tempmin[u]<0){
				num3.push(u);
			}
			
		}

		for(var d=0;d<num3.length+1;d++){

			
	 if(num3[d+2]-num3[d]==2){
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>');
  	 $('#red').show();
  $('#warnings').show();
	 
			
		}
	}
	for(var a=0;a<tempmax.length;a++){
				if(tempmax[a]<32){
				num4.push(a);
			}
					}
					
		for(var n=0;n<num4.length;n++){
			if(num4[n+1]-num4[n]==1){
	 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');

  	 $('#yellow').show();
  $('#warnings').show();
	 
			}
		}
			}
		
						weather(tempmax,tempmin);
								
				}
			
			}
			if(strUser==2){
				for(var j=1;j<4;j++){
								$("#info").append("Day"+(k+j)+"                   "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));
                                     
								tempmax.push(Math.round(((data.list[datevalue+j].temp.max-273.15)*9/5)+32));
                                tempmin.push(Math.round(((data.list[datevalue+j].temp.min-273.15)*9/5)+32));
								function weather(tempmax,tempmin){
	for(var u=0;u<tempmax.length;u++){
			if(tempmax[u]<10 && tempmin[u]<0){
				num3.push(u);
			}
			
		}

		for(var d=0;d<num3.length+1;d++){

			
	 if(num3[d+2]-num3[d]==2){
 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>');
  	 $('#red').show();
  $('#warnings').show();
	 
			
		}
	}
	for(var a=0;a<tempmax.length;a++){
				if(tempmax[a]<32){
				num4.push(a);
			}
					}
					
		for(var n=0;n<num4.length;n++){
			if(num4[n+1]-num4[n]==1){
	 $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');

  	 $('#yellow').show();
  $('#warnings').show();
	 
			}
		}
			}
		
								weather(tempmax,tempmin);
								
				}
			

			}
			
			

					
			
	}
	wcount++;
	}
else{
	
		if(strUser3==0){
			if(k1+strUser3+1<10){
		$("#info").append("Day"+(k1+strUser3+1)+"                     "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));
			}
			else{
			$("#info").append("Day"+(k1+strUser3+1)+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));
			
			}
			}
	if(strUser3==1){
		if(k1+strUser3<10){
					$("#info").append("Day"+(k1+strUser3)+"                     "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));
	
		}
		else{
			$("#info").append("Day"+(k1+strUser3)+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));
	
		}
	}
	if(strUser3==2){
		if(k1+strUser3-1<10){
							$("#info").append("Day"+(k1+strUser3-1)+"                     "+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));

		}
		else{
				$("#info").append("Day"+(k1+strUser3-1)+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"              "+Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"              "+Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32));

		}
	}
	
	
}
	
if(k==0){
	if(strUser3==0){
		var temp1=Math.round(((data.list[k+strUser+strUser3+3].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k+strUser+strUser3+3].temp.min-273.15)*9/5)+32)
			}
			if(strUser3==1){
				var temp1=Math.round(((data.list[k+strUser+strUser3+2].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k+strUser+strUser3+2].temp.min-273.15)*9/5)+32)
			}
			if(strUser3==2){
	var temp1=Math.round(((data.list[k+strUser+strUser3+1].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k+strUser+strUser3+1].temp.min-273.15)*9/5)+32)
			}	
	
}
else{
	if(strUser3==0){
		var temp1=Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32)
		}
	if(strUser3==1){
	var temp1=Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32)
	}
	if(strUser3==2){
var temp1=Math.round(((data.list[k1+strUser3+2].temp.max-273.15)*9/5)+32);
var temp2=Math.round(((data.list[k1+strUser3+2].temp.min-273.15)*9/5)+32)
	}

}   
if(temp1<32)
{

num.push(k);



for(var h2=0;h2<num.length;h2++)
{
if(num[h2+1]-num[h2]==1)
{
 
sequence.push(num[h2+1]);

}
}

 $.each(sequence, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
	
 for (var z = 0; z < result.length; z++)
 {
	 if(k==result[z])
	 {
		 $('#info').append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="yellow.png">'+'</div>');
		 
		 $('#yellow').show();
  $('#warnings').show();


 }
 }
 
	 
  
 
	 
 

 




 
 

 
}


if(temp1<10 && temp2<0)
{





num1.push(k);


for(var h1=0;h1<num1.length;h1++)
{
	
 if(num1[h1+2]-num1[h1]==2)
{
 

sequence1.push(num1[h1+2]);
}
$.each(sequence1, function(i, e) {
        if ($.inArray(e, result1) == -1) result1.push(e);
    });
	
 for (var q = 0; q< result1.length; q++)
 {
	 if(k==result1[q])
	 {
		
		  $("#info").append('<div style=" width:10px; height:27px; margin-left:-25px; margin-top:-27px; ">'+'<img src="red.png">'+'</div>');
		  
		 y.push(result1[q]);
		

 
		  
 



	
	 }
	
  	 $('#red').show();
  $('#warnings').show();

 }

  

  
}
}
}
  if(weathercounter==0){
	 
  $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?lat='+location2.lat()+'&lon='+location2.lng()+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
						 	if(strUser3==0){
							if((t-(-strUser-strUser3-1))<10){
	      $( "#info" ).append("Day"+(t-(-strUser-strUser3-1))+"&nbsp;"+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3-1)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3-1)].temp.min-273.15)*9/5)+32)+"</br>");
							
							}
							else{
      $( "#info" ).append("Day"+(t-(-strUser-strUser3-1))+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3-1)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3-1)].temp.min-273.15)*9/5)+32)+"</br>");
							}
		}
	if(strUser3==1){
		if((t-(-strUser-strUser3))<10){
      $( "#info" ).append("Day"+(t-(-strUser-strUser3))+"&nbsp;"+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3)].temp.min-273.15)*9/5)+32)+"</br>");
			
		}
		else{
      $( "#info" ).append("Day"+(t-(-strUser-strUser3))+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3)].temp.min-273.15)*9/5)+32)+"</br>");
	
	}
	}
	if(strUser3==2){
		if((t-(-strUser-strUser3)-1)<10){
			      $( "#info" ).append("Day"+(t-(-strUser-strUser3)-1)+"&nbsp;"+"&nbsp;"+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3+1)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3+1)].temp.min-273.15)*9/5)+32)+"</br>");

		}
		else{
      $( "#info" ).append("Day"+(t-(-strUser-strUser3)-1)+":"+"&nbsp;"+data.city.name+" <div style=margin-left:200px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[t-(-strUser-strUser3+1)].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[t-(-strUser-strUser3+1)].temp.min-273.15)*9/5)+32)+"</br>");
		}
	}
	
		if(strUser3==0){
			var temp=  Math.round(((data.list[t-(-strUser-strUser3-1)].temp.min-273.15)*9/5)+32);
		}
	if(strUser3==1){
	var temp=  Math.round(((data.list[t-(-strUser-strUser3)].temp.min-273.15)*9/5)+32);
	}
	if(strUser3==2){
var temp=  Math.round(((data.list[t-(-strUser-strUser3+1)].temp.min-273.15)*9/5)+32);
	}
	
	
     test(temp);
	 },400)});
    
  function test(temp)
  {
 if(temp<20)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
for(var i=0;i<checkdistances1.length;i++)
			{
			if((checkdistances1[i+1]-checkdistances1[i])>965.606){
  Flight3.setMap(null);
			}
			if(i==t-3){
				if(((distance3+distance8)-checkdistances1[checkdistances1.length-1])>965.606){
			
					  Flight3.setMap(null);
				}
			}
			}
  }
 
	
  weathercounter++;
  weathercounter1++;
} 



}
var counter=0;

  function test1()
{

return counter=counter+1;

}
var a=0;
function test2()
{

return a=a+1;

}
      
  
  function enddetails13(k2,t,m1,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [m1,{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	  {lat: 47.6587802, lng:  -117.4260466}
	    ],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails12(k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	   {lat: 47.6587802, lng:  -117.4260466}
	],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails11(k2,t,m1,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [ {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	  {lat: 47.6587802, lng:  -117.4260466}
	   ],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails10(k2,t,m1,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [m1,{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816}],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails9(k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816}
	],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails8(k2,t,m1,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [ {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816}],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
   function enddetails7(k2,t,m1,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [m1,{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816},
	{lat: 47.6062095, lng: -122.3320708}],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [m1,location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails6(k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [{lat: 40.7607793, lng: -111.8910474},
    {lat: 42.8713032, lng:  -112.4455344},
	  {lat: 45.7965211, lng: -119.3122389},
	    {lat: 45.5230622, lng:  -122.6764816},
	{lat: 47.6062095, lng: -122.3320708}],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails5(location4,location5,location6,k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [{lat: 42.8713032, lng:  -112.4455344},location4,location6,location5],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
}
   }
  function enddetails4(location4,location5,location6,k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [location4,location6,location5],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 
}
   }
  function enddetails2(location4,location5,k2,t,DrivePath,address2)
   {
	
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [location4,location5 ],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 
}
	var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
  }
	
	function enddetails3(location3,k2,t,DrivePath,address2)
   {
	 
     $.getJSON('http://api.openweathermap.org/data/2.5/forecast/daily?q='+address2+'&cnt=16&mode=json&APPID=f445c5c0ab5fe17b3a86807d237f710c',  function (data) {
                     console.log(data);
					 setTimeout(function(){ 
      $( "#info" ).append("Day"+t+" :   "+data.city.name+" <div style=margin-left:300px;><div style=margin-top:-20px;> "+"High"+"          "+Math.round(((data.list[k2-1].temp.max-273.15)*9/5)+32)+"    /   "+"Low"+"         "+Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32)+"</br>");
	var temp=  Math.round(((data.list[k2-1].temp.min-273.15)*9/5)+32);
     test(temp);
	 },4500)});
    
  function test(temp)
  {
 if(temp<73)
	  {
	 var text3= "Please insure prompt unloading of cargo"
	$("#info").append('<div style="margin-left:-25px; margin-top:-20px;">'+'<img src="orange.png">'+'</div>');
	var Flight3 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location3 ],
    strokeColor: '#EDAB47',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  $('#warnings').show();
	$('#orange').show();
	
	  }
	 else{
	 $('#orange').hide();
	
	 }
	 
}
	var Flight9 = new google.maps.Polyline({
    path: [DrivePath[DrivePath.length-1],location2 ],
    strokeColor: '#009900',
    strokeOpacity: 1.0,
    strokeWeight: 2,
    map: map
  });
  Flight9.setMap(map);
  }
  $("#popup").animate({'margin-bottom': "-30px"});
	}
function SaveRoute(){
 //get the form values
var valuearray=[];
var starting_address = $('#autocomplete').val();     
 var destination_address = $('#autocomplete1').val();     
 var email=$('#email').val();
var select=document.getElementById("ddlViewBy");
if((starting_address && destination_address)!=""){ 
var option = document.createElement("option");
option.text = starting_address+"->"+destination_address;
option.value =starting_address+"->"+destination_address;
}
var valueNull="";
 //make the postdata
 var postData = 'starting_address='+starting_address+'&destination_address='+destination_address+'&email='+email;
for (i = 0; i < document.getElementById("ddlViewBy").length; ++i){
 valuearray.push(document.getElementById("ddlViewBy").options[i].value);
	
	
}
 //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

$.each(valuearray,function(key,value){
	if(value==starting_address+"->"+destination_address){
		valueNull=starting_address+"->"+destination_address;
	}
});
if(valueNull==""){
	$.ajax({
    url : "input.php",
    type: "POST",
    data : postData,
    success: function(data,status, xhr)
    {
		
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
       alert(data);

    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
});
select.appendChild(option);
 valuearray.push(option.value);
}
else{
	alert("Route already exists");
}
}
function myFunction() {
	var e = document.getElementById("ddlViewBy").value;
var res = e.split("->");
if(e!='Select Route')
{
	$('#save').hide();
	$('#delete').show();
	 var location1 = res[0];
var location2 = res[1];
document.getElementById("autocomplete").value=location1;
document.getElementById("autocomplete1").value=location2;
}
else if(e=='Select Route')
{
	$('#delete').hide();
	$('#save').show();
document.getElementById("autocomplete").value="";
document.getElementById("autocomplete1").value="";
}

   

}
function loadFunction() {
	var datearray=[];
	var c = document.getElementById("selectloaddate");
var strUser3 =c.selectedIndex;

var g= document.getElementById("selectdate");
 function pad(s) { return (s < 10) ? '0' + s : s; }
var someDate = new Date();
var dd = someDate.getDate();
var mm = someDate.getMonth() + 1;
var yy = someDate.getFullYear();
if(strUser3==0){
	
g[0].innerHTML=Date.parse('t + 1 d').toString("MM/dd/yyyy");; 
g[1].innerHTML=Date.parse('t + 2 d').toString("MM/dd/yyyy");;
g[2].innerHTML=Date.parse('t + 3 d').toString("MM/dd/yyyy");;
}
if(strUser3==1){
	
g[0].innerHTML=Date.today().add(2).days().toString("MM/dd/yyyy");;
g[1].innerHTML=Date.today().add(3).days().toString("MM/dd/yyyy");;
g[2].innerHTML=Date.today().add(4).days().toString("MM/dd/yyyy");;
}
if(strUser3==2){
	
g[0].innerHTML=Date.today().add(3).days().toString("MM/dd/yyyy");;
g[1].innerHTML=Date.today().add(4).days().toString("MM/dd/yyyy");;
g[2].innerHTML=Date.today().add(5).days().toString("MM/dd/yyyy");;
}
}

function SendFeedback(){
	
var feedback=document.getElementById("myTextarea").value;
var email=document.getElementById("sendemail1").value;
if(feedback==""){
	alert("Please enter your feedback");
}
else{
	$('#loading-indicator').show();
var postData='feedback='+feedback+'&email='+email; 
$.ajax({
	url : "feedbackmail.php",
	type : "POST",
	data : postData, 
	dataType : "text",
	tryCount : 0,
    retryLimit : 3,
	success: function(data,status, xhr)
    {
		 $('#loading-indicator').hide();
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
       alert(data);
	   document.getElementById("myTextarea").value="";
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        
		if (jqXHR.status == 500) {
             this.tryCount++;
            if (this.tryCount <= this.retryLimit) {
                //try again
                $.ajax(this);
                return;
            }            
            return;
        }
		else{
		
		
alert("Feedback could not be sent.there was an error " + errorThrown);  
		}
    }
});
}
}
function DeleteRoute(){
if(document.getElementById("autocomplete").value===""){ 
	alert("Please Select a Route");
	}
else{
	var x = document.getElementById("ddlViewBy");
    
	var m=(document.getElementById("ddlViewBy").value);
	var split=m.split("->");
	var starting_address=split[0];
	var destination_address=split[1];
	var email=$('#email').val();
	
 var postData = 'starting_address='+starting_address+'&destination_address='+destination_address+'&email='+email;
 $.ajax({
    url : "delete.php",
    type: "POST",
    data : postData,
    success: function(data,status, xhr)
    {
		
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
       alert(data);
	   x.remove(x.selectedIndex);
  document.getElementById("autocomplete").value="";
document.getElementById("autocomplete1").value="";
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
});
}
}
function SendInvite(){
 
 $('#loading-indicator').show();
	var email=document.getElementById("sendemail").value;
var postData='email='+email;
$.ajax({
	url : "sendmail.php",
	type : "POST",
	data : postData, 
	success: function(data,status, xhr)
    {
		 $('#loading-indicator').hide();
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
       alert(data);
document.getElementById("sendemail").value="";
	   
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
    }
});
	
}
</script>

</head>
<body>

<div class="container-fluid">
  <div id="r" style="margin-left:-15px;">
  <div class="row">
   <div class="col-sm-4 col-sm-offset-1" id="feedbackform" style="margin-left:55px;display:none;">
	
	
	<a class="navbar-brand" href="#">
                <img src="logo.png" alt="" width="350"height="75" style="margin-left:-70px;margin-top:-28px;"> 
            </a><br/><br/>
   
    
	<div class="col-lg-12">
		   <div class="form-group"style="margin-top:50px; margin-left:-20px;">
			
			
			<div id="btn">

   <button type="button" class="btn btn-large btn-default" id="main" style="margin-top:-40px; margin-left:-34px;background-color:background-color:#F0F8FF;;"id="clickme2" >Back</button><br/>
   

   </div>
			
 
	  <h4 class="modal-title" style="margin-top:10px;margin-left:-33px;"><i class="icon-paragraph-justify2"></i> Send Feedback</h4>
      
	
		
                        
						
						
						<form class="form-signin" action="sendmail.php"method="POST" id="login_form"> 
        <form role="form">
            <div class="col-lg-10">
              
               
                <div class="form-group" style="margin-left:-20px; margin-top:10px;">
                  
                   <div class="col-sm-14"><textarea rows="10" cols="50" id="myTextarea" style="margin-left:-24px;"></textarea>
		          </div>
				</br>
				 
             
      <button class="btn btn-sm btn-danger " style="margin-left:-24px;"   type="button" name="submit" id="btn-login" onclick='SendFeedback()'>Submitt</button> <br/><br/> </form></form>
	    <input type='hidden' id='sendemail1' value='<?php  echo  $_SESSION['login_user']; ?>'/>

	  </div>
</div>
 </div>
	</div>
  </div>
  
 <div class="col-sm-4 col-sm-offset-1" id="siteloader" style="margin-left:55px;"  >
	
	
	<a class="navbar-brand" href="#">
                <img src="logo.png" alt="" width="350"height="75" style="margin-left:-70px;margin-top:-28px;"> 
            </a>  <button class="btn btn-md btn-primary " type="submit" name="route" id='feedback'   style="margin-top:10px;">Feedback</button><br/><br/>
 
     <div class="form-group" id="locationField" style=" position: absolute; margin-top:0px;" >
  
  <div id="welcome" style='margin-left:-38px;'>Logged in as  <i><?php echo  $_SESSION['login_user']; ?></i></div><div id='logout'style=" margin-top:-18px;margin-left:280px;"><a href="logout.php">Logout</a></div>
  <input type='hidden' id='email' value='<?php  echo  $_SESSION['login_user']; ?>'/>
	<div id='list'style="margin-top:-3px;margin-left:-40px;">Favorite Route</br><select onChange="myFunction();" id="ddlViewBy"><option selected="selected" >
Select Route
</option><?php 
$email=$_SESSION['login_user']; 
	
$sql = "SELECT starting_address,destination_address,time FROM routes where email='$email'";


$retval = mysql_query( $sql, $c );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$route=array();
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	$route[]=$row['starting_address']."->".$row['destination_address']; 
	$result=array_unique($route);
	
  
         
      
} 
foreach($result as $key=>$value)
{
 ?><option  id='option1' > <?php echo ($value);?></option><?php
}

?>
</select>


</div>
      <img class="img-responsive" src="first-location.png" alt=""style="margin-left:-55px;margin-top:0px;"/>   <input type="text" id="autocomplete" class="form-control" name="autocomplete" onchange="calcRoute(); " placeholder="Enter Shipping Location" required="" style="height:28;width:300px; margin-top:-40px; margin-left:-20px;background-color:#F0F8FF;"/>
	   
	   

 <img class="img-responsive" src="end-loction.png" alt=""style="margin-left:-55px;margin-top:-3px;"/>  <input type="text" id="autocomplete1" class="form-control" name="autocomplete1" placeholder="Enter Destination"  required="" style="height:28;width:300px;margin-top:-33px; margin-left:-20px; background-color:#F0F8FF;" /></div>
		  
		  </br><br/>
<div id="rail" style="display: list-item;margin-top:109px;margin-left: -220px;">
<div id='extra' style='margin-top:-24px;'> <select id='selectroute'   ><option>Select</option><option>BNSF</option><option>UP</option></select></div> 
<div id='loaddate'  style='margin-top:-22px;'><img class="img-responsive" src="transittime.png" alt=""style="margin-top:7px;margin-left:385px;"><div id='extra' style='margin-top:-24px;margin-left:201px;'>Load Date      <select id='selectloaddate' onChange="loadFunction();" ><option><?php echo date("m/d/Y"); ?></option><option> <?php $datetime = new DateTime('tomorrow'); echo $datetime->format('m/d/Y'); ?> </option><option><?php $datetime = new \DateTime('tomorrow + 1day'); echo $datetime->format('m/d/Y'); ?></option></select></div></div>	 
<div id='date' margin-left:10px;><img class="img-responsive" src="transittime.png" alt=""style="margin-top:-22px;margin-left:175px;"><div id='extra' style='margin-top:-24px;margin-left:411px;'>Ship Date       <select id='selectdate'   ><option> <?php $datetime = new DateTime('tomorrow'); echo $datetime->format('m/d/Y'); ?> </option><option><?php $datetime = new \DateTime('tomorrow + 1day'); echo $datetime->format('m/d/Y'); ?></option><option><?php $datetime = new \DateTime('tomorrow + 2day'); echo $datetime->format('m/d/Y'); ?></option></select></div></div></div>
<div id="time"style="margin-top:7px; margin-left:-20px;"><img class="img-responsive" src="transittime.png" alt=""style="margin-left:-25px;"> <p style="margin-top:-22px; margin-left:2px;"> Estimated Transit Time : </div> 
   
<div class="col-sm-6" style=" margin-top:-35px; margin-left:140px;">
 <select id="mySelect" class="form-control" style="margin-left:0px;">
      
	<option value="1">1 Day</option>
    <option value="2">2 Day</option>
    <option value="3">3 Day</option>
    <option selected value="4">4 Day</option>
    <option value="5">5 Day</option>
	<option value="6">6 Day</option>
	<option value="7">7 Day</option>
	<option value="8">8 Day</option>
	
</select>
</div>
  <div  style=" margin-top:-36px;margin-left:-40px;display:none;" >	<img class="img-responsive" src="chicago.png" alt=""style="margin-left:-5px;margin-top:47px;"> <p style="margin-top:-18px; margin-left:20px;">Shipment going through Chicago:</p>
  
  <form role="form"style=" margin-left:30px; margin-top:10px;">
    <div id="radios" style="margin-top:-30px; margin-left:210px;">
      <input type="radio" id="Select2" value="yes"  name="optradio"><strong>Yes</strong><div id="popup" style="display: none; margin-top:0px;text-align:center;">Please allow an extra 24hours for shipments transiting through Chicago</div>
      <label><input type="radio"  value="no" id="Select3"   name="optradio" style="margin-left:10px;" checked>No</label>
    </div>
  
  </form>
  
</div><br/>


 
 <button class="btn btn-md btn-default " type="submit" name="submit" id="calculate" onclick="setTimeout(initialize1(),3000);" style="margin-top:-30px; margin-left:-46px;background-color:#F0F8FF;">Submit</button> 
  <button class="btn btn-md btn-default " type="submit" name="route" id="save"  onclick="SaveRoute();" style="margin-top:-30px; margin-left:10px;background-color:#F0F8FF;">Save Route</button> 
    <button class="btn btn-md btn-default " type="submit" name="route1" id="delete"  onclick="DeleteRoute();" style="display:none;margin-top:-30px; margin-left:10px;background-color:#F0F8FF;">Delete Route</button> 

  <div id='warning_section'>
  <div id="warnings_panel" style="width:90%;height:10% text-align:center"></div>
  <div id="info1" style="height:10px;margin-top:20px;"> 

</div>
<div id="info" style="height:10px;margin-top:0px;margin-left:-20;"> 

</div>
</br>
<div id="info5" style="margin-top:248px; margin-left:-10px; position:absolute;">
<div id="warnings" style="margin-bottom:-38px; margin-left:-25px; margin-top:-36px;display:none;"><strong>Warnings:</strong></div>
<div id='red'style='margin-top:35px;'><img src="red.png"style="margin-bottom:0px; margin-left:-35px; margin-top:0px;"/>Consider Shipping OTR with Blanket or Postpone Shipping</div><br/>
<div id='yellow' style='margin-top:15px;'><img src="yellow.png"style="margin-bottom:0px; margin-left:-35px; margin-top:0px;"/>Warning for beverages with low suger content or glass packaging</div><br/>
<div id='orange'style='margin-top:-5px;'><img src="orange.png"style="margin-bottom:0px; margin-left:-35px; margin-top:0px;"/>Please Ensure prompt unloading of cargo</div>
</div>
</div>   
</div>
   
      <div class="col-sm-6"style="margin-left:0px; ">
      <div class="google-map-canvas " id="map-canvas">
      </div>
  </div>
<img src="loading.gif" id="loading-indicator" style="display:none;margin-top: 350px;margin-left: -1100px; height: 150;" />
</div>
</div>
</div>
  </body>
</html>
	

	

	
	
  


	

	


	
	

	

	
	

	

	
	

	
	
  


	

	
	
