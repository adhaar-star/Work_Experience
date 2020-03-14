<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
   	 @if(!empty($vendors->all()))
   	 <div class="table-responsive">
      <table class="table">
         <thead>
         	<tr class="headings">
         		<th>VendorId</th>
         		<th>Username</th>
         		<th>Email</th>
            <th>StoreName</th>
            <th>Action</th>
         	</tr>
         </thead>
         <tbody>
         	@foreach($vendors->all() as $vendor)
         	  <tr>
         	  	<td>{{ @$vendor->id  }}</td>
         	  	<td>{{ @$vendor->username  }}</td>
         	  	<td>{{ @$vendor->email  }}</td>
              <td>{{ @$vendor->store->storeName }}</td>
         	  	<td><a class="btn btn-default btn-sm" title="view settings" href="{{ Helper::adminUrl('setting/vendor/'.$vendor->id) }}"><i class="fa fa-cog fa-lg" aria-hidden="true"></i>
</a></td>
         	  	
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