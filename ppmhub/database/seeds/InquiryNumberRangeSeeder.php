<?php

use Illuminate\Database\Seeder;
use App\Inquirynumber_range;

class InquiryNumberRangeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('inquirynumber_range')->truncate();
        $data = [
            [1000000, 1999999],
        ];

        foreach ($data as $value) {
            Inquirynumber_range::create([
                'start_range' => $value[0],
                'end_range' => $value[1],
                'company_id' => 0
            ]);
        }
    }

}
