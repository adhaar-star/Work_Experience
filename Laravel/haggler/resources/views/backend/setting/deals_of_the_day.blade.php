<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
<?= Helper::alert() ?>
<h3>Set Deals Of The Day </h3>
  <div class="row">
   <div class="col-md-12">
   	  @if(!empty($deals->all()))
      <form action="{{ Helper::adminUrl('setting/deals-of-the-day') }}" method="post">
         {{csrf_field()}}
   	  <div class="table-responsive">
		  <table class="table">
		    <thead>
		    	<tr class="headings">
		    		<th>Deal Name</th>
		    		<th>Make Deal of the Day</th>
		    	</tr>
		    </thead>
		     @foreach($deals->all() as $deal)
                <tr>
                	<td>{{ $deal->offerName }}</td>
                	<td><input type="checkbox" {{ $deal->deal_of_the_day == "yes" ? "checked" : '' }} class="dod" name="dod[]" value="{{ $deal->offerId }}"></td>
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
      jQuery('.dod').click(function(e){
      	  
      	  if(jQuery('input[name="dod[]"]:checked').length > 10){
      	    alert("You can choose only 10 deals.");
      	  	e.preventDefault();
      	  	return false;
      	  }
      });
 	});
 </script>
@stop
