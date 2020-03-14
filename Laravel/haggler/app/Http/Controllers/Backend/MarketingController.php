<?php
namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Device;
use App\Models\Upload;

class MarketingController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'marketing']);
			
	}

	public function getNotifications() {


		$this->layout->content = view('backend.marketing.notifications.form');
		return $this->layout;

	}

	public function postNotifications(\Illuminate\Http\Request $request) {

		$devices = Device::whereRaw('device_id is not null and device_id != ""')->get();

		if (!$devices || empty($devices->all())) {

		return redirect($this->adminBase('marketing/notifications'))->with(['message' => $this->alert('No users.', 'alert-success')]);
		}



		foreach ($devices as $device) {

			if ($device->device_type == 'ios') {	
				$o = \PushNotification::app('appNameIOS');
			}

			if ($device->device_type == 'android') {
				$o = \PushNotification::app('appNameAndroid');
			}

			if (is_object($o)) {

				$message = \PushNotification::Message($request->get('message'), array(
				    
				    'meta_data' => array('type' => 'push','message' => $request->get('message'),'title' => $request->get('title') )
				));

           		$o = $o->to($device->device_id)->send($message);

           		//var_dump($o);
           		//exit;
        	}
        }

		return redirect($this->adminBase('marketing/notifications'))->with(['message' => $this->alert('Notification sent successfully.', 'alert-success')]);
		
	}

}