<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
<h3>Settings ( {{ $vendor->username }} ) </h3>
  <div class="row">
   <div class="col-md-12">
   	 @if(!empty($settings))
   	 <div class="table-responsive">
      <table class="table">
         <thead>
         	<tr class="headings">
         		<th>#</th>
            <th>Setting</th>
         		<th>Action</th>
         	</tr>
         </thead>
         <tbody>
         	@foreach($settings as $key => $setting)
         	  <tr>
         	  	<td>{{ $key+1 }}</td>
         	  	<td>{{ $setting  }}</td>
              <?php
                switch($setting){

                  case 'pincode' : 
                        $url = Helper::adminUrl('setting/pincode/view/'.$vendor->id);
                        break;

                  case 'change_password' :
                        $url = Helper::adminUrl('setting/change-password/'.$vendor->id);
                        break;

                  case 'products_of_the_day' :
                        $url = Helper::adminUrl('setting/products-of-the-day');
                        break; 

                  case 'deals_of_the_day' :
                        $url = Helper::adminUrl('setting/deals-of-the-day');
                        break;             
 
                }

              ?>
         	  	<td><a href="{{ $url }}">View</a></td>
         	  	
         	  </tr>
         	@endforeach
         </tbody>
      </table>
    </div>  
     @endif
    

   </div>
  </div>

</div>  

@stop
