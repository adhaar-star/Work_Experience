<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message;
use \App\Models\MessageThread;
use App\Models\User;
use Auth;
use DB;

class MessageController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'message']);
			
	}

	public function getIndex() {

		$user_id = Auth::id();

		if(\Auth::user()->role == "admin"){
			$results = MessageThread::orderBy('last_update', 'desc');
		}
        else{
		  $t = MessageThread::where('receiver_id', $user_id);
		  $results = $t->orderBy('last_update', 'desc');
		}

		if(\Input::get('from')){
			$f = \Input::get('from');
			$fromUser = User::select("id")->where("username","like","%$f%")->get();

			$results = $results->whereIn("sender_id",$fromUser->toArray());


		}

		if(\Input::get('to')){
			$to = \Input::get('to');
			$toUser = User::select("id")->where("username","like","%$to%")->get();

			$results = $results->whereIn("receiver_id",$toUser->toArray());


		}


		if(\Input::get('q')){

			$q =\Input::get('q');

			$user = User::select("id")->where("username","like","%$q%")->get();

			

			$results = $results->where(function($w)use($q,$user){

				    return $w->where("subject",'like',"%$q%")
				    ->orWhereIn('sender_id',$user->toArray())
				    ->orWhereIn('receiver_id',$user->toArray())
				    ->orWhere('last_message','like',"%$q%");

			});

			


		}

		if (!empty(\Input::get('from_date'))) {
   						$results = $results->where('last_update', '>=', \Input::get('from_date'));
  		}

		if (!empty(\Input::get('to_date'))) {
		   		$results = $results->where('last_update', '<=', \Input::get('to_date'));
		 }


		$results = $results->get();
		

		

		$this->layout->content = view('backend.message.index', ['threads' => $results]);
		return $this->layout;

	}

	public function getOpenConversation(\Illuminate\Http\Request $request) {
	date_default_timezone_set('Asia/Kolkata');
		 $date = date('Y-m-d H:i:s');
		$thread_id = \Input::get('thread_id');
		$t = MessageThread::find(\Input::get('thread_id'));

		$result_update = Message::where('thread_id', '=', $thread_id)->update(['is_read' => 1]);

		if (!$t) {
			return response()->json(['success' => false]);
		}

		$m = Message::with('sender', 'receiver')->where('thread_id', \Input::get('thread_id'))->orderBy('id', 'desc');

		$limit = $request->get('limit', 15);

		if (\Input::has('last_message')) {
			$m = $m->where('id', '<', \Input::get('last_message'));
		}

		if (\Input::has('timestamp')) {
			$m = $m->where('created_at', '<', \Input::get('timestamp'));
		}

		$results = $m->paginate($limit);

		
		$messages =  array_reverse($results->all());
		$o['body'] = view('backend.message.conversation', ['messages' => $messages])->render();
		$o['pages'] = $results->lastPage();
		$o['count'] = $results->count();	
		$o['success'] = true;
		$o['thread_id'] = $t->id;
		$o['receiver_id'] = $t->sender_id;
		$o['last_message_timestamp'] = $t->last_update;
		//$o['last_message_timestamp'] = $date;
		return response()->json($o);
		

		//$this->layout->content = view('backend.message.conversation', ['messages' => $messages]);
		//return $this->layout;

	}

	public function postSend(\Illuminate\Http\Request $request) {
		
		$thread_id = $request->get('thread_id');
		$receiver_id = $request->get('receiver_id');

		$thread = MessageThread::where('receiver_id', \Auth::id())->find(57);

		//$thread = MessageThread::where('receiver_id', 2)->find(57);


//if (!$thread) die('thread not found');

		$v = User::where('role', 'customer')->find($receiver_id);

		//if (!$v) die('user not found');

		if (!$v || !$thread) {

			return redirect()->back()->with(['message' => $this->alert('Unable to find buyer or thread is invalid.', 'alert-danger')]);
		}

		$v = \Validator::make($request->all(), [
				'message' => 'required|max:2000',
			]);

		if ($v->fails()) {
			return redirect()->back()->with(['message' => $this->alert('Message is empty.', 'alert-danger')]);

		}

		$message = $request->get('message');
		try {
	
				DB::beginTransaction();
			    date_default_timezone_set('Asia/Kolkata');
				$timestamp = date('Y-m-d H:i:s');
				$thread_data = ['last_message' => $message, 'last_update' => $timestamp ];
				
				//MessageThread::updateOrCreate(['id' => $thread_id, 'receiver_id' => \Auth::id(), 'sender_id' => $thread->sender_id], $thread_data);
		MessageThread::updateOrCreate(['id' => $thread_id, 'receiver_id' =>$receiver_id , 'sender_id' => $thread_id], $thread_data);
			
				$m = new Message();
				$m->thread_id = $thread_id;
				$m->receiver_id = $receiver_id;
				$m->sender_id = \Auth::id();
				$m->message = $message;
				$m->created_at = $timestamp;
				$m->save();

				DB::commit();

			} catch (\Exception $e) {

					DB::rollback();
					echo $e;

					exit;

	
				
			}

		return redirect()->back()->with(['message' => $this->alert('Message Sent.', 'alert-success')]);

	}

	public function getThreadUpdate() {

	}

	public function getGlobalAlert() {

	}

	
}