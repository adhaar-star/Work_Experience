@if (!empty($messages))
	@foreach ($messages as $message)
		<li>
		
		<p class="pull-left" style="width:100%">{{$message->message}}</p>
		<p class="pull-left" style="width:100%">
		<small class="pull-left">Date: {{date('d M, y | H:i:s', strtotime($message->created_at))}}</small>
		<small class="pull-right">By: {{$message->sender->username}}</small>
		</p>
		</li>
	@endforeach
@endif