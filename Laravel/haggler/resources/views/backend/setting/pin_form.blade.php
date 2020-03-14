<?php
use \App\Models\Helper;
?>
@section('content')
<style>
	#map_canvas

	  {
        height: 400px;
        width: 600px;
        margin-top: 0.6em;
      }

</style>
<div class="container-fluid">
 <?= Helper::alert() ?>
  <div class="row">
   <div class="col-md-6">

     <form action="{{ Helper::adminUrl('setting/pincode/save') }}" method="post">
       {{csrf_field()}}
      @if(Auth::user()->role == 'admin')
       <div class="form-group">
         <label for='vendor' >Select Vendor</label>
         <div class="col-sm-12">
           <select class="form-control" name="vendor_id" required>
              @if(!empty($vendors->all()))
                 @foreach($vendors->all() as $vendor)
                   <option value="{{ $vendor->id }}">{{ @$vendor->store->storeName }}</option>
                 @endforeach
              @endif
           </select>
         </div> 

       </div>

       @else
       <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}">

      @endif 
       
       <div class="form-group">
         <label for='address' >Address</label>
         <div class="col-sm-12">
           <input type="text" name="address" id="address" class="form-control" required>
         </div>

       </div>

       <div class="form-group">
         <label for='pincode' >Pincode</label>
         <div class="col-sm-12">
           <input type="text" name="pincode" id="pincode" class="form-control" required>
         </div>

       </div>
       <div style="display:none">
	       <input type="radio" name="type" id="changetype-all" checked="checked">
	      <label for="changetype-all">All</label>

	      <input type="radio" name="type" id="changetype-establishment">
	      <label for="changetype-establishment">Establishments</label>

	      <input type="radio" name="type" id="changetype-geocode">
	      <label for="changetype-geocode">Geocodes</lable>
	      </label>
      </div>
       
       <input type="submit" class="btn btn-primary" value="submit" style="margin-top:17px">
     </form>
    

   </div>
   <div class="col-md-6">
  	    <div id="zip_code" style="display:none"></div>
  	 	<div id="map_canvas"></div>
  	</div>
  </div>


  	 
  

</div>  



@stop

@section('after_footer')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
 <script>
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(-33.8688, 151.2195),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'),
          mapOptions);

        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          infowindow.close();
          var place = autocomplete.getPlace();
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }

          var image = new google.maps.MarkerImage(
              place.icon,
              new google.maps.Size(71, 71),
              new google.maps.Point(0, 0),
              new google.maps.Point(17, 34),
              new google.maps.Size(35, 35));
          marker.setIcon(image);
          marker.setPosition(place.geometry.location);

          var address = '';
          var zip_code = '';
          document.getElementById('zip_code').innerHTML=zip_code;
          document.getElementById('pincode').value=zip_code;
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
            for (var i=0; i<place.address_components.length;i++)
	    {
              for (var j=0;j<place.address_components[i].types.length;j++)
              {
                if (place.address_components[i].types[j] == "postal_code")
                {
                  zip_code = place.address_components[i].long_name;
                  document.getElementById('zip_code').innerHTML=zip_code;
                  document.getElementById('pincode').value=zip_code;
                }
              }
	    }
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          google.maps.event.addDomListener(radioButton, 'click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>


    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-162157-1";
urchinTracker();
</script> 

@stop
