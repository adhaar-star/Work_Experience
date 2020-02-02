<?php

use Illuminate\Database\Seeder;
use App\country;

class CountryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('state')->truncate();
        DB::table('country')->truncate();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://services.groupkt.com/country/get/all");
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($server_output);
        $fn_data = $data->RestResponse;
        $country = $fn_data->result;
        foreach ($country as $key => $value) {
            $list = array(
                'country_name' => $value->name,
                'code' => $value->alpha3_code
            );
            country::create($list);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}