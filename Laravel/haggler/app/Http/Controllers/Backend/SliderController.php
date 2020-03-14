<?php


namespace App\Http\Controllers\Backend;


use App\Models\User;
use App\Models\Upload;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Event;

class SliderController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'slider']);
			
	}

	public function getCreate() {

		$slider = Slider::first();

	
		if ($slider) return redirect()->to($this->adminBase('slider/manage'));


		$slider = new Slider;


		$this->layout->content = view('backend.slider.form', ['slider' => $slider, 'page_title' => 'New Slider']);
		return $this->layout;

	}

	public function getManage(  ) {

		$slider = Slider::first();

	
		if (!$slider) return redirect()->to($this->adminBase('slider/create'));

	
		$this->layout->content = view('backend.slider.form', ['slider' => $slider, 'page_title' => 'Edit Slider']);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

	
		$slider = Slider::first();

	

		$rules = 'create';

		$redirect = $this->adminBase('slider/create');


		if ($slider) {
			
			$redirect = $this->adminBase('slider/manage' );
			$rules = 'update';
		
		} else {
			$slider = new Slider;
		}

		$valid = \Validator::make($request->all(), Slider::rules($rules));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->except('image_1', 'image_2', 'image_3', 'image_4'));
		}

		$image1 = Upload::move('slider', $request, 'image_1', true);
		$image2 = Upload::move('slider', $request, 'image_2', true);
		$image3 = Upload::move('slider', $request, 'image_3', true);
		$image4 = Upload::move('slider', $request, 'image_4', true);

		$collection = [];

		for ($i=1; $i<=4; $i++) {

			$img = "image$i";

			if (empty($$img))
			{
				$$img = basename($slider->getImage($i));
			}

			$type = $request->get("type_$i");
			$id = $request->get("id_$i");
			$link = $request->get("link_$i");
			echo "$type - $id <br>";
			if ($img) {

				
				switch ($type) {

					case 'product':
						$product = Product::find($id);
						if ($product) {
							array_push($collection, ['id' => $id, 'type' => $type, 'image' => url('assets/images/slider', [$$img]), 'source' => $link]);
						}
					break;

					case 'deal':
						$deal = Deal::find($id);
						if ($deal) {
							array_push($collection, ['id' => $id, 'type' => $type, 'image' => url('assets/images/slider', [$$img]), 'source' => $link]);
						}
					break;

					case 'event':
						$deal = Event::find($id);
						if ($deal) {
							array_push($collection, ['id' => $id, 'type' => $type, 'image' => url('assets/images/slider', [$$img]), 'source' => $link]);
						}
					break;

				}

			}

		}

		if (empty($collection)) {
			return redirect()->back()->with(['message' => $this->alert('Unable to save slider', 'alert-danger')]);
		}

		$slider->meta_data = $collection;

		
	
		$slider->title = $request->get('title');
		
		if ( $slider->save() ) {
			return redirect($this->adminBase('slider/manage'));
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to save slider.', 'alert-danger')]);

	}

	public function getDelete($id) {

		$id = Slider::find($id);

		if (!$id) {
			abort(404);
		}
		
		$id ->delete();

		return redirect($this->adminBase('slider'))->with(['message' => $this->alert('Slider deleted successfully.', 'alert-success')]);

	}
	
}