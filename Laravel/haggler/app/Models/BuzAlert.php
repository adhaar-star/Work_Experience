<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BuzAlert extends Model {

	protected $table = 'buzline_alerts';

	protected $hidden = ['updated_at', 'data'];

    protected $fillable = ['vendor_id', 'user_id', 'message'];

	/*public function setDataAttribute($v) {
		//$this->attributes['data'] = serialize($v);
	}

	public function getDataAttribute() {
		!empty($this->attributes['data']) ? unserialize($this->attributes['data']) : [];
	}*/

    public static function add($vendor, $what, $data) {
        ///usr/local/bin

        switch ($what) {
            case 'product':
                $type = 'product';

                $message = $vendor->store->storeName . ' added 1 new product';
                break;

            case 'deal':
                $type = 'deal';
                $message = $vendor->store->storeName . ' added 1 new deal';
                break;

            case 'event':
                $type = 'event';
                $message = $vendor->store->storeName . ' added 1 new event';
                break;
        }

        if (isset($message)) {
           /* echo "php E://xampp//htdocs//haggler//artisan. alert:add {$vendor->id} {$type} \"$data\" \"$message\"";

            exec("php \"E:\\xampp\\htdocs\\haggler\\artisan.\" alert:add {$vendor} {$type} \"$data\" \"$message\" 2>&1", $out, $in);
            var_dump($out);
            var_dump($in);*/

           // echo "usr/local/bin/php /home2/hagglcrc/public_html/haggler.in/dev/artisan alert:add $vendor->id $type \"$data\" \"$message\"  ";
            exec("php /var/www/artisan alert:add $vendor->id $type \"$data\" \"$message\" >> /dev/null 2>&1", $out, $in);

        }
    }


    public function getDataImagesAttribute(){
        if(!empty($this->attributes['data_images'])){
            return json_decode($this->attributes['data_images']);
        }
    }

}