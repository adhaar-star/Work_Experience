<?php


namespace App\Http\Controllers\Backend;


use App\Models\User;
use App\Models\Upload;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Event;
use App\Models\SliderImage;

class SliderImageController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'slider']);
			
	}

	public function getDelete($id){

       $d = SliderImage::where('id',$id)->delete();
       if($d){
       	  return redirect()->back()->with(['message' => ['text' => 'Slider image removed.','class' => 'alert-success']]);
       }

        return redirect()->back()->with(['message' => ['text' => 'Unable to remove slider image.','class' => 'alert-danger']]);

	}
}
