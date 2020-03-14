<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealImage extends Model {

	protected $table = 'deal_images';

	public $timestamps = false;


	

	public function toArray()
    {
        $array = parent::toArray();
      
      	$images = [];

      	if (!empty($array['image_1'])) {

      		array_push($images, \URL::to('assets/images/deal/' . $array['image_1']));
      		
      	}

      	if (!empty($array['image_2'])) {

      		array_push($images, \URL::to('assets/images/deal/' . $array['image_2']));
      		
      	}
      	if (!empty($array['image_3'])) {

      		array_push($images, \URL::to('assets/images/deal/' . $array['image_3']));
      		
      	}
      	if (!empty($array['image_4'])) {

      		array_push($images, \URL::to('assets/images/deal/' . $array['image_4']));
      		
      	}

        foreach ($images as $k => $v) {
          /*if (empty($v)) {
            $images[$k] = "";
          } else {
            $images[$k] = $v;
          }*/
          if (!empty($v)) {
            $array[$k] = $v;
          } 
        }
        return $images;
    }

    public function getImageSrc($image) {
      return url('assets/images/deal', [$image]);
    }

   
}