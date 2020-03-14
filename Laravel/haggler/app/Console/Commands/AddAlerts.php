<?php
/**
 * Version: 1.0
 * Author: Ultrabytes (harcharan@bytesultra.com)
 * Date: 4/28/2016
 * Time: 5:23 PM
 */

namespace App\Console\Commands;

use App\Models\BuzAlert;
use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Deal;
use App\Models\Event;



class AddAlerts extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:add {vendor} {type} {data} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add alert to buzline';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->info("Vendor Id " . $this->argument('vendor'));
        $this->info("Message " . $this->argument('message'));
        $this->info("Data " . $this->argument('data'));
        //$this->info("Images " . $this->argument('data'));

        $user = User::find($this->argument('vendor'));

        if ($user) {
            $message = $this->argument('message');


            $followers = \DB::table('store_followers')->select('user_id')->where('vendor_id', $user->id)->get();
            $store = Store::where('vendorId',$user->id)->first();
            $storeImage = $store->storeImage;
            $storeName = $store->storeName;
            $dataImages = "";
            switch($this->argument('type')){
                case 'product' :
                $dataImages = Product::with('images')->where('productId',$this->argument('data'))->get();
                break;

                case 'deal':
                $dataImages = Deal::where('offerId',$this->argument('data'))->get();
                break;

                case 'event':
                $dataImages = Event::where('eventId',$this->argument('data'))->get();
                break;


            }

            if (!empty($followers)) {

                $data = [];

                foreach ($followers as $follower) {

                    $old_buz = BuzAlert::where('type', $this->argument('type'))->where('user_id', $follower->user_id)->where('vendor_id', $user->id)->whereRaw('Date(created_at) = CURDATE()');
                     

                    $old_buz = $old_buz->first();

                    $buz_data = $this->argument('data');
                    // if ($old_buz) {
                    //     preg_match('/[(0-9)+]/', $old_buz->message, $matches);

                    //     if (!empty($matches[0])) {

                    //         $index_count = intval($matches[0]) + 1;
                    //         $replacement = " {$index_count} ";
                    //         $message = preg_replace('/ (\d+) /i', $replacement, $old_buz->message);
                    //         $buz_data = $old_buz->data . '|' . $buz_data;
                            
                    //         $old_buz->message = $message;
                    //         $old_buz->data = $buz_data;
                    //         $old_buz->save();

                    //     } else {
                    //          $data[] = ['vendor_id' => $user->id, 'user_id' => $follower->user_id,'image'=>$storeImage,"store_name" => $storeName, 'data' => $buz_data, 'type' => $this->argument('type'), 'message' => $message];
                    
                    //     }

                    // } else {

                    $data[] = ['vendor_id' => $user->id, 'user_id' => $follower->user_id, 'data' => $buz_data,'image'=>$storeImage, "store_name" => $storeName,'type' => $this->argument('type'), 'message' => $message,'data_images' => $dataImages->toJson()];
                    
                   }
                }

                BuzAlert::insert($data);
            }


        }
    }

