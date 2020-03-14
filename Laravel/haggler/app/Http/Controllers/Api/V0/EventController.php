<?php

namespace App\Http\Controllers\Api\V0;

use \App\Models\Event;
use \App\Models\DealCategory;
use App\Models\Store;

class EventController  extends ApiController {
	
	
	public function all( \Illuminate\Http\Request $request ) {

		$limit = $request->get('limit', 15);

		$events = Event::selectRaw('eventId as id, eventId, eventTitle as name, eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage, eventStatus');
		
		$order = 'desc';

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			
		}

		$events = $events->orderBy($request->get('orderBy', 'id'), $order);

		$events = $events->paginate($limit);

		$data['items'] = $events->all();
		$data['pages'] = $events->lastPage();
		$data['count'] = $events->count();

		//var_dump($data);

		return $this->response($data);


	}

	public function view() {

		$id = \Input::get('eventId');

		$event = Event::selectRaw('eventId as id, eventId, eventVendorId, eventTitle as name, eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage, eventStatus')->where('eventId', $id)->first();

		if (!$event) abort(404);

		$moreEventByVendor = Event::selectRaw('eventId as id, eventId, eventVendorId, eventTitle as name, eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage, eventStatus')->where('eventVendorId', $event->eventVendorId)->where('eventId','!=',$id)->get();

		
		$store = Store::where('vendorId', $event->eventVendorId)->first();

		$data = $event->toArray();
		$data['dealVendorName'] = @$store->storeName;
		$data['profileImage'] = @$store->storeImage;
		$data['moreEventByThisVendor'] = @$moreEventByVendor;
		
		return $this->response($data);

	}

	
}