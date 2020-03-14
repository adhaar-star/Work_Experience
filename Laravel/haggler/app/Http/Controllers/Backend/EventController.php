<?php


namespace App\Http\Controllers\Backend;


use App\Models\BuzAlert;
use App\Models\User;
use App\Models\Upload;
use App\Models\Event;
use App\Models\SliderImage;
use Auth;

class EventController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'event']);
			
	}

	public function getIndex(\Illuminate\Http\Request $request) {



		if (\Auth::user()->role === 'admin') {
			$events = Event::orderBy('eventId', 'desc');
		} else {
		  	$events = Event::where('eventVendorId', \Auth::id())->orderBy('eventId', 'desc');
		}

		if (!empty($request->get('from'))) {
			$events = $events->where('created_at', '>=', $request->get('from'));
		}

		if (!empty($request->get('to'))) {
			$events = $events->where('created_at', '<=', $request->get('to'));
		}

		if (!empty($request->get('q'))) {

               $q = $request->get('q');
               $events = $events->where('eventTitle','like',"%$q%");

		}

		if (!empty($request->get('vn'))) {

               $vn = $request->get('vn');
               $events = $events->where('eventAddress','like',"%$vn%");

		}



		$events = $events->paginate(30);

		

		$this->layout->content = view('backend.events.index', ['events' => $events]);
		return $this->layout;
	}

	public function getCreate() {

		$event = new Event;

		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();

		$this->layout->content = view('backend.events.form', ['vendors' => $vendors, 'event' => $event,'adminVendor' => $adminVendor, 'page_title' => 'New Event']);
		return $this->layout;

	}

	public function getEdit( $id ) {

		

		if (\Auth::user()->role === 'admin') {
			$event = Event::find($id);
		} else{
			$event = Event::where('eventVendorId', \Auth::id())->find($id);
		}

		if (!$event) abort(404);

		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();
		 $sliderImage =SliderImage::where('type','event')->where('type_id',$id)->first();
	
		$this->layout->content = view('backend.events.form', ['vendors' => $vendors, 'event' => $event, 'adminVendor' => $adminVendor,'page_title' => 'Edit Event','sliderImage' => $sliderImage]);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

		$event = new Event;

		$rules = 'create';

		$redirect = $this->adminBase('event/create');


		if (!empty($request->get('eventId'))) {

			$id = $request->get('eventId');

			if (\Auth::user()->role === 'admin') {
				$event = Event::find($id);
			} else{
				$event = Event::where('eventVendorId', \Auth::id())->find($id);
			}

			
			$redirect = $this->adminBase('event/edit/' . $request->get('eventId') );
			$rules = 'update';

			if (!$event) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), Event::rules($rules));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->except('offerImage'));
		}

		$image = Upload::move('event', $request, 'eventImage');

		
	
		$event->eventTitle = $request->get('eventTitle');
		if (!empty($image)) {
			$event->eventImage = $image;
		}	
		
		$event->eventStartDate = $request->get('eventStartDate');
		$event->eventEndDate = $request->get('eventEndDate');
		$event->eventStatus = $request->get('eventStatus', 0);
		$event->eventDescription = $request->get('eventDescription');
		$event->eventAddress = $request->get('eventAddress');	


		if (\Auth::user()->role === 'admin') {
			$event->eventVendorId = $request->get('eventVendorId');
			$event->eventStatus = "active";
		} else{
			$event->eventVendorId = \Auth::id();
			$event->eventStatus = "inactive";
		}

	
		if ( $event->save() ) {

            if (empty($request->get('eventId'))) {
                BuzAlert::add(Auth::user(), 'event', $event->eventId);
            }

           /********** add product slider **********/
			if($request->get('slider_on') == 'on'){

			if(!empty($request->file('slider_image'))){

                  $sliderImage = $request->file('slider_image');
                  $destinationPath = 'slider_images';
                  $extension = $sliderImage->getClientOriginalExtension();
                  $sliderImageName = 'slider-'.time().".".$extension;
                  $sUpload = $sliderImage->move($destinationPath, $sliderImageName);
                  if($sUpload){
                     	$sI = new SliderImage;

	                  	if(!empty($request->get('eventId'))){

	                  		$sI = SliderImage::where('type','event')->where('type_id',$request->get('eventId'))->first();
	                  		if(empty($sI)){
	                  			$sI = new SliderImage;
	                  		}

	                  	 }

	                  	 
	                  	 $sI->type = 'event';
	                  	 $sI->type_id = $event->eventId;
	                  	 $sI->slider_image = url('slider_images/'.$sliderImageName);
	                  	 $sI->save();

                  }
			}

		}

		   /***** end  product slider *******************/

			return redirect($this->adminBase('event'))->with(['message' => $this->alert('Event saved.', 'alert-success')]);
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to save event.', 'alert-danger')]);

	}

	public function getDelete($id) {

		$eventId = Event::find($id);

		if (!$eventId) {
			abort(404);
		}
		
		$eventId ->delete();

		SliderImage::where('type_id',$id)->where('type','event')->delete();

		return redirect($this->adminBase('event'))->with(['message' => $this->alert('Event deleted successfully.', 'alert-success')]);

	}
	
}