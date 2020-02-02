<?php

use Illuminate\Database\Seeder;
use App\quotationNumber;

class QuotationNumberRangeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('quotationNumber_range')->truncate();
        $data = [
            [2000000, 2999999],
        ];

        foreach ($data as $value) {
            quotationNumber::create([
                'start_range' => $value[0],
                'end_range' => $value[1],
                'company_id' => 0
            ]);
        }
    }

}
