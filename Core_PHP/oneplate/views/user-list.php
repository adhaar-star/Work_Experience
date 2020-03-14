<div class="row">
    <h2>All Active Users</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
					
                    <th title="User who listed this meal" style="width:12%"><span class="glyphicon glyphicon-user"></span>Name</th>
                  
                    <th title="Category of meal" style="width:15%"><span class="glyphicon glyphicon-list"></span>address1</th>
                    <th title="Time left to expire for this meal" style="width:15%"><span class="glyphicon glyphicon-time"></span> Time Left</th>
                  
                    <th title="contact number of user" style="width:10%"><span class="glyphicon glyphicon-phone-alt"></span> Contact</th>
                    <th title="contact number of user" style="width:12%"><span class="glyphicon glyphicon-eye-open"></span> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $active_listings = $db->get_user_listings($pagination->get_limit(), $pagination->get_start());

                if (!empty($active_listings)) {
                   // $calc_at = $active_listings['calc_at'];
                    //unset($active_listings['calc_at']);
                    foreach ($active_listings as $record) {
                        echo '<tr>';
                        echo '<td>' .
                        anchor(['href' => 'meal-user-detail.php?id=' . $record['user_id'],
                            'text' => $record['first_name']." ".$record['last_name'],
                            'attr' => [
                                'title' => 'See user profile',
                                'target' => '_blank'
                            ]], $return = true) .
                        '</td>';
                        echo '<td>' .
                       $record['address1'] .
                        '</td>';
                        echo '<td >' . $db->get_remaining_time($record['expire_hour']) . '</td>';
                       // echo '<td>' . substr($record['description'], 0, 100) . '...</td>';
                        echo '<td>' . $record['telephone'] . '</td>';
                        echo '<td><button type="button" class="btn btn-xs btn-primary center-block"><span class="glyphicon glyphicon-fullscreen" data-name="',$record['first_name']." ".$record['last_name'],'" data-location="',$record['address1'],'"
                        data-time="',$db->get_remaining_time($record['expire_hour']),'"
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
                    <label for="phone" style="font-weight: bold;">User <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="name"></p>
              
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                
                    <label for="email" style="font-weight: bold;">address1 <strong class="text-danger"></strong></label>
                    <p class="form-control-static" id="location"></p>
                
            </div>
        </div>
        <div class="row">
            
			
			<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="address12" style="font-weight: bold;">Time Left</label>
                    <p class="form-control-static" id="time"></p>
                </div>
            </div>
        </div>
        <div class="row">
           
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