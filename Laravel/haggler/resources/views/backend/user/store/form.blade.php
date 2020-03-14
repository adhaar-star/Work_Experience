<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> </h3>

      </div>
      <div class="panel-body">

          <form action="<?= Helper::adminUrl('store/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($store->storeId)) 
                <input type="hidden" name="storeId" value="{{$store->storeId}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>

                <div class="form-group">
                <div class="col-sm-12">
                                      
                   <div class="form-group  {{ $errors->has('storeName') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Store Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="storeName" value="{{Input::old('storeName', $store->storeName)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('storeName') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('storeImage') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Store Image <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="file" name="storeImage" class="form-control">
                      <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                      <div class="help-block">{{ $errors->first('storeImage') }}</div>
                      </div>
                      <div class="col-sm-12">
                      @if(!empty($store->storeImage))
                      <img src="{{ $store->storeImage }}" width="100" alt="{{ $store->storeName }}">
                      @endif
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('storeDescription') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Store Description <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea name="storeDescription" class="form-control">{{Input::old('storeDescription', $store->storeDescription)}}</textarea>
                        <div class="help-block">{{ $errors->first('storeDescription') }}</div>
                      </div>
                  </div>

                </div>

                <div class="col-sm-8">

                   <div class="form-group  {{ $errors->has('address') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Address <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="address" value="{{Input::old('address', $store->address)}}" class="form-control" id="address" onfocus="geolocate()" required>
                        <div class="help-block">{{ $errors->first('address') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('city') ? 'has-error' : '' }}">
                       <label class="col-sm-12">City <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="city" id="locality" value="{{Input::old('city', $store->city)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('city') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('state') ? 'has-error' : '' }}">
                       <label class="col-sm-12">State <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="state" id="administrative_area_level_1" value="{{Input::old('state', $store->state)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('state') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('lat') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Lat <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="lat" id="lat" value="{{Input::old('lat', $store->lat)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('lat') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('lng') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Lng <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="lng" id="lng" value="{{Input::old('lng', $store->lng)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('lng') }}</div>
                      </div>
                  </div>

                  </div>

                  <div class="col-sm-4">

                  <div id="map"></div>

                  </div>

                </div>

            

          <div class="form-group">
            <div class="col-sm-12">
              <button class="btn btn-default"><i class="fa fa-plus"></i> Save</button>
          </div>
      </div>

  </div>
</form>
</div>
</div>
</div>
</div>
@stop


@section('after_footer')
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDLc0jMP8TyOc4PWbnaEb3MJhE_M2hzcoQ"></script>

<script>
  var placeSearch, autocomplete;

  var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'short_name',
      postal_code: 'short_name'
  };

  @if (!empty($store->storeId)) 
    //initMap({{$store->lat}}, {{$store->lng}});
    var myLatLng = {lat: {{$store->lat}}, lng: {{$store->lng}}};
    var mapOptions = {
      center: myLatLng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
  @else
    var mapOptions = {
      center: new google.maps.LatLng(-33.8688, 151.2195),
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
  @endif

  var geocoder = new google.maps.Geocoder();

  var map = new google.maps.Map(document.getElementById('map'), mapOptions);

  @if (!empty($store->storeId))
    var marker = new google.maps.Marker({
      position: myLatLng,
      draggable:true,
      map: map,
      title: '{{$store->storeName}}',
      
    });
  @else
    var marker = new google.maps.Marker({
      map: map,
      draggable: true
    });
  @endif

  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }

  autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('address')),
    { componentRestrictions: {country: "in"}}
  );

  /*On entering new address in the field*/
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    console.log("here");
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat(),
          lng = place.geometry.location.lng();
      $("#lat").val(lat);
      $("#lng").val(lng);
      for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            var eL  = document.getElementById(addressType);
            if (eL) {
              eL.value = val;
            }
          }
      }
      map.setCenter(place.geometry.location);
      var image = new google.maps.MarkerImage(
         //place.icon,
         new google.maps.Size(71, 71),
         new google.maps.Point(0, 0),
         new google.maps.Point(17, 34),
         new google.maps.Size(35, 35)
      );
      marker.setIcon(image);
      marker.setPosition(place.geometry.location);
  });

  google.maps.event.addListener(marker, 'dragend', function (event) {
    //geocodePosition(marker.getPosition());
    //console.log('place');
    var place = marker.getPosition();
    var lat = place.lat(),
        lng = place.lng();
    $("#lat").val(lat);
    $("#lng").val(lng);
    geocoder.geocode({
      latLng: place
    }, function(responses) {
      if (responses[1]) {

          console.log(responses[1]);
        for (var i=0; i<responses[0].address_components.length; i++) {
          for (var b=0;b<responses[0].address_components[i].types.length;b++) {
            if (responses[0].address_components[i].types[b] == "administrative_area_level_1") {
              state= responses[0].address_components[i];
            }
            if (responses[0].address_components[i].types[b] == "administrative_area_level_2") {
              city= responses[0].address_components[i];
            }
          }
        }
        $('#administrative_area_level_1').val(state.short_name);
        $('#locality').val(city.short_name);

        $('#address').val(responses[1].formatted_address);
      }
    });
    //map.setCenter(place);
    var image = new google.maps.MarkerImage(
       new google.maps.Size(71, 71),
       new google.maps.Point(0, 0),
       new google.maps.Point(17, 34),
       new google.maps.Size(35, 35)
    );
    //marker.setIcon(image);
    marker.setPosition(place);
  });

</script>
<style>
      
  #map {
    height: 100%;
    width: 100%;
    min-width: 320px;
    height: 320px;
  }
  </style>

@stop