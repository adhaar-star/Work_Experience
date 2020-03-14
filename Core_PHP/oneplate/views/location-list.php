<div class="row">
    <h2>All Locations</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                 
                    <th title="Location of meal" style="width:15%"><span class="glyphicon glyphicon-map-marker"></span> Location</th>
					
				   <th title="Location of meal" style="width:15%"><span class="glyphicon glyphicon-map-marker"></span>Provenance</th>
					
					
                    <th title="contact number of user" style="width:12%"><span class="glyphicon glyphicon-eye-open"></span> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
if(isset($_GET['q'])){
	$search=$_GET['q'];
	$locations=$db->get_search_location_listings($pagination->get_limit(), $pagination->get_start(),$search);
}else{
$locations=$db->get_location_listings($pagination->get_limit(), $pagination->get_start());

                $active_listings = $db->get_active_listings($pagination->get_limit(), $pagination->get_start());
}
                if (!empty($locations)) {
                    //$calc_at = $active_listings['calc_at'];
                   // unset($active_listings['calc_at']);
                    foreach ($locations as $record) {
                        echo '<tr>';
                       
                        echo '<td>' .
                        anchor(['href' => 'meal-location-detail.php?id=' . $record['id'],
                            'text' => $record['name'],
                            'attr' => [
                                'title' => 'See all listing of this location',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
						
						 echo '<td>' .
                        anchor(['href' => 'meal-provenance-detail.php?id=' . $record['id'],
                            'text' => $record['provenance'],
                            'attr' => [
                                'title' => 'See all listing of this location',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
                      
                      
                        echo '<td><button type="button" class="btn btn-xs btn-primary center-block"><span class="glyphicon glyphicon-fullscreen" data-location="',$record['name'],'"data-provenance="',$record['provenance'],'" data-toggle="modal" data-target="#quoteView"></span></button></td>';
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
    <?php echo $pagination->generate(); ?>
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
                
                    <label for="email" style="font-weight: bold;">Location <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="location"></p>
                
            </div>
				<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="address2" style="font-weight: bold;">Provenance</label>
                    <p class="form-control-static" id="provenance"></p>
                </div>
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
            $('#location').html(request.data('location'));
			$('#provenance').html(request.data('provenance'));           
        });
    });
		</script>