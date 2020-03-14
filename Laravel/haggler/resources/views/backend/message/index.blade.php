<?php
use \App\Models\Helper;
?>
@section('content')
<style>
.row.message-item {
	border-bottom: 1px solid #ccc;
	color: #000;
	padding: 18px;
}
.w{
	background: #FCF9F6;
}

.s{
	background: #EEE9E4;
}

</style>
<div class="container-fluid">

	@if (Input::has('thread_id'))
	@else
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Filter Messages</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-12">
						<div class="back_filter">
							<form>
								<div class="col-sm-2">
									<div class="form-gorup">
										<label>Keyword</label>
										<div class="col-sm-12 nopadding">
											<input type="text" value="{{Input::get('q')}}" name="q" class="form-control ">
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-gorup">
										<label>From</label>
										<div class="col-sm-12 nopadding">
											<input type="text" value="{{Input::get('from')}}" name="from" class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-gorup">
										<label>To</label>
										<div class="col-sm-12 nopadding">
										<input type="text" value="{{Input::get('to')}}" name="to"  class="form-control">
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-gorup">
										<label>From Date</label>
										<div class="col-sm-12 nopadding">
											<input type="text" value="{{Input::get('from_date')}}" name="from_date" class="form-control datepicker ">
										</div>
									</div>
								</div>

								<div class="col-sm-2">
									<div class="form-gorup">
										<label>To Date</label>
										<div class="col-sm-12 nopadding">
											<input type="text" value="{{Input::get('to_date')}}" name="to_date"  class="form-control datepicker ">
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-gorup">
										<label>&nbsp;</label>
										<div class="col-sm-12">
											<button class="btn btn-primary">Filter</button>
										</div>
									</div>
								</div>
								<div class="clear"></div>
							</form>
						</div> 
					</div>
				</div>
			</div>
		</div>
	@endif
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Manage Messages</h3>
			</div>
			<div class="panel-body"> 
				<div class="row message-container">
					<div class="col-md-12"> 
						<div class="message-list">
								<table class="table table-hover">
									<thead>
										<th>S. No.</th>
										<th>From</th>
										<th>To</th>
										<th>Subject</th>
										<th>Last Message</th>
										<th>Date and Time</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php  $index = 0; $count = 1; ?>
										@if (!empty($threads->all()))
											@foreach($threads as $thread)
												<?php //var_dump($thread);exit; ?>
												<tr {{ in_array($thread->id,$thread_ids) ? "class = msg_back" : "" }}>
													<td>{{$count++}}</td>
													<td>{{@$thread->sender->username}}</td>
													<td>{{@$thread->receiver->username}}</td>
													<td>{{@$thread->subject}}</td>
													<td><?php 
														$str = $thread->last_message;
														if (strlen($str) > 70)
	   														$str = substr($str, 0, 70)."...";
	   														echo $str; ?>
   													</td>
													<td>{{ date('d M, y H:i:s', strtotime($thread->last_update)) }}</td>
													<td><a href="javascript:void(0)" onclick="window.location='{!!Helper::adminUrl('message')!!}?thread_id={{$thread->id}}'" class="btn btn-lg action_eye"><span class="glyphicon glyphicon-eye-open"></span></a></td>
												</tr>
												<?php $index++;  ?>
											@endforeach
										@else
											<div class="alert alert-warning">No message found.</div>
										@endif
									</tbody>
								</table>
						</div>
					</div>
				</div><!-- end message container -->
				@if (Input::has('thread_id'))
					<div class="row">
						<div class="col-md-12">
							<div id="opened-conversation">
								<ul id="opened-conversation-list" style="padding:25px">
								</ul>
							</div>
						</div>
					</div>
				@endif
				<div class="row message-form" style="display:none">
					<div class="col-md-12">
						<div id="message-write-panel">
							<form action="{!!Helper::adminUrl('message/send')!!}" method="post">
								{{csrf_field()}}
								<input type="hidden" name="thread_id" id="thread_id" value="{{Input::get('thread_id')}}">
								<input type="hidden" name="receiver_id" id="receiver_id" value="">
								<div class="col-sm-10">
									<textarea name="message" class="form-control"></textarea>
								</div>
								<div class="col-sm-2">
									<button class="btn btn-block btn-default">Send</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>		
@stop

@section('after_footer')

@if (Input::has('thread_id'))
<script>
function getTimeStamp() {
	var myDate = new Date();
	return myDate.getFullYear() + '-' + (myDate.getMonth()+1) + '-'
	+ myDate.getDate() + ' ' + myDate.getHours() + ':' + myDate.getMinutes() + ':' 
	+ myDate.getSeconds();
}

var last_message_timestamp = getTimeStamp();

$(function () {

	$.ajax({
		url: "{!!Helper::adminUrl('message/open-conversation')!!}",
		data: {thread_id: {{Input::get('thread_id')}} },
		method: 'get',
		success: function (o) {

			

			if (o.success && o.count > 0) {
				console.log(o);
				$('.message-container').hide();
				$('.message-form').show();
				$("#opened-conversation-list").html(o.body);
				$("#thread_id").val(o.thread_id);
				$("#receiver_id").val(o.receiver_id);
				last_message_timestamp = o.last_message_timestamp;
				setTimeout(function () {
					$("#opened-conversation").scrollTop($('#opened-conversation').height());
				}, 200);
				
			}

		}	
	});

	setInterval(function () {

		/*var timeString = */

		$.ajax({
			url: "{!!Helper::adminUrl('message/open-conversation')!!}",
			data: {thread_id: {{Input::get('thread_id')}}, timestamp: last_message_timestamp },
			method: 'get',
			success: function (o) {

				if (o.success && o.count > 0) {
					$("#opened-conversation-list").append(o.body);
					$("#thread_id").val(o.thread_id);
					$("#receiver_id").val(o.receiver_id);
					last_message_timestamp = o.last_message_timestamp;
					setTimeout(function () {
						$("#opened-conversation").scrollTop($('#opened-conversation').height());
					}, 200);
				}
			}
		});	
	}, 3000);
});

</script>
@endif

@stop