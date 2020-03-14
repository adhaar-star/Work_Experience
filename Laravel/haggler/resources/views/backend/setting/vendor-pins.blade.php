<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
<?= Helper::alert() ?>
  <div class="row">
   <div class="col-md-12 category_heading">

   <h3>Pincodes ( {{ $vendor->username }} ) <a href="{{Helper::adminUrl('setting/pincode/create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a></h3>

   	 @if(!empty($vendorPins->all()))
   	 <div class="table-responsive">
      <table class="table">
         <thead>
         	<tr class="headings">
         		<th>#</th>
            <th>Address</th>
         		<th>Pincode(s)</th>
                <th>Action</th>
         	</tr>
         </thead>
         <tbody>
         	@foreach($vendorPins->all() as $key => $vendorPin)
         	  <tr>
         	  	<td>{{ $key+1 }}</td>
              <td>{{ $vendorPin->address }}</td>
         	  	<td>{{ $vendorPin->pincode  }}</td>
         	  	<td><a class="btn btn-danger btn-sm" href="{{ Helper::adminUrl('setting/pincode/delete/'.$vendorPin->id)}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i>
</a></td>
         	  	
         	  </tr>
         	@endforeach
         </tbody>
      </table>
    </div>  
    @else
      <div class="alert alert-warning">No pincode found for this vendor.</div>
     @endif

    

   </div>
  </div>

</div>  

@stop
