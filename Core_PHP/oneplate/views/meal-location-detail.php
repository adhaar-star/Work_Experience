<div id="contain">
<script>

	function change()
{
   
	 var change = document.getElementById("myButton1");
                if (change.innerHTML == "Active List")
                {
                    change.innerHTML = "Expired List";
					
					
					
                }
                else {
                    change.innerHTML = "Active List";
                }
	
	var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
  return query_string;
}();
	var expiredid=QueryString.id;
	
	
	var request = $.ajax({
  url: "meal-location-detail-expired.php",
  type: "GET",
  data: {id : expiredid},
  dataType: "html"
});

request.done(function(msg) {
  $("#contain").html($(msg).find('#contain').html() );
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});
	
	
}
</script>
	
<div class="row">
		<button class='btn btn-danger pushme' id="myButton1" style="float: right;" onclick="change()" >Expired List</button>
    <h2>All Active Listings</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th title="User who listed this meal" style="width:12%"><span class="glyphicon glyphicon-user"></span> User</th>
                    <th title="Location of meal" style="width:15%"><span class="glyphicon glyphicon-map-marker"></span> Location</th>
                    <th title="Category of meal" style="width:15%"><span class="glyphicon glyphicon-list"></span> Category</th>
                    <th title="Time left to expire for this meal" style="width:15%"><span class="glyphicon glyphicon-time"></span> Time Left</th>
                    <th title="Description added by user for this meal" style="width:20%"><span class="glyphicon glyphicon-comment"></span> Desc..</th>
                    <th title="contact number of user" style="width:10%"><span class="glyphicon glyphicon-phone-alt"></span> Contact</th>
                    <th title="contact number of user" style="width:12%"><span class="glyphicon glyphicon-eye-open"></span> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
$categoryid=$_GET['id'];
                $active_listings = $db->get_location_active_listings($pagination->get_limit(), $pagination->get_start(),$categoryid);
                if (!empty($active_listings)) {
                    $calc_at = $active_listings['calc_at'];
                    unset($active_listings['calc_at']);
                    foreach ($active_listings as $record) {
                        echo '<tr ' . $db->get_listing_warning($record['expire_after']) . '>';
                        echo '<td>' .
                        anchor(['href' => 'meal-user-detail.php?id=' . $record['user_id'],
                            'text' => $record['user_name'],
                            'attr' => [
                                'title' => 'See user profile',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
                        echo '<td>' .
                        anchor(['href' => 'meal-location-detail.php?id=' . $record['location_id'],
                            'text' => $record['location'],
                            'attr' => [
                                'title' => 'See all listing of this location',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
                        echo '<td>' .
                        anchor(['href' => 'meal-cat-detail.php?id=' . $record['meal_name'],
                            'text' => $record['meal_name'],
                            'attr' => [
                                'title' => 'See all listing in this meal category',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
                        echo '<td title="Calculated on ' . $calc_at . '">' . $db->get_remaining_time($record['expire_after']) . '</td>';
                        echo '<td>' . substr($record['description'], 0, 100) . '...</td>';
                        echo '<td>' . $record['telephone'] . '</td>';
                        echo '<td><button type="button" class="btn btn-xs btn-primary center-block"><span class="glyphicon glyphicon-fullscreen" data-name="',$record['user_name'],'" data-location="',$record['location'],'"
                        data-category="',$record['meal_name'],'"
                        data-time="',$db->get_remaining_time($record['expire_after']),'"
                        data-description="',$record['description'],'"
                        data-phone="',$record['telephone'],'" data-toggle="modal" data-target="#quoteView"></span></button></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr>'
                    . '<td colspan="7" class="bg-warning text-center"><h4>No Record Found</h4></td>'
                    . '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
       <?php       if (!empty($active_listings) && $active_listings[0]!="") {

    echo $pagination->generate();} ?>
</div>
	<div class="modal fade" id="quoteView" tabindex="-1" role="dialog" aria-labelledby="quoteViewLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="quoteViewTitle">User Details</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="phone" style="font-weight: bold;">User <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="name"></p>
              
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                
                    <label for="email" style="font-weight: bold;">Location <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="location"></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="address1" style="font-weight: bold;">Category<strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="category"></p>
             
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="address2" style="font-weight: bold;">Time Left</label>
                    <p class="form-control-static" id="time"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
               
                    <label for="city" style="font-weight: bold;">Description<strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="description"></p>
                
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
               
                    <label for="state" style="font-weight: bold;">Contact <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="phone"></p>
               
            </div>
        </div>
        <div class="row">
            
            
        </div>
        <div class="row">
        <!--    <div class="col-md-12" style="margin-bottom: 20px">
                <div class="form-group">
                    <label for="message">Your message</label>
                    <textarea placeholder="Your message" name="message" id="message" class="form-control" tabindex="11"></textarea>
                </div>
            </div>-->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
	<script>
		
		 $(document).ready(function() {
		
        $('#quoteView').on('show.bs.modal', function (event) {
			
            var request = $(event.relatedTarget); // HTML element that triggered the modal
            $('#name').html(request.data('name'));
            $('#phone').html(request.data('phone'));
            $('#location').html(request.data('location'));
			$('#category').html(request.data('category'));
            $('#description').html(request.data('description'));
               $('#time').html(request.data('time'));
        });
    });
		</script>
	
</div>
