<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
<?= Helper::alert() ?>
<h3>Set Products Of The Day </h3>
  <div class="row">
   <div class="col-md-12">
   	  @if(!empty($products->all()))
      <form action="{{ Helper::adminUrl('setting/products-of-the-day') }}" method="post">
         {{csrf_field()}}
   	  <div class="table-responsive">
		  <table class="table">
		    <thead>
		    	<tr class="headings">
		    		<th>Product Name</th>
		    		<th>Make Product of the Day</th>
		    	</tr>
		    </thead>
		     @foreach($products->all() as $product)
                <tr>
                	<td>{{ $product->productName }}</td>
                	<td><input type="checkbox" {{ $product->product_of_the_day == "yes" ? "checked" : '' }} class="pod" name="pod[]" value="{{ $product->productId }}"></td>
                </tr>
   	      
   	         @endforeach
		  </table>
		</div>
		<input type="submit" value="Submit" class="btn btn-primary">
   	   </form>
   	  @endif
    </div>  
   </div>
  </div>

 

@stop

@section('after_footer')
 <script>
 	jQuery(function(){
      jQuery('.pod').click(function(e){
      	  
      	  if(jQuery('input[name="pod[]"]:checked').length > 10){
      	    alert("You can choose only 10 products.");
      	  	e.preventDefault();
      	  	return false;
      	  }
      });
 	});
 </script>
@stop
