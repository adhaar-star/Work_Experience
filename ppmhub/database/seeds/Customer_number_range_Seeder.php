<?php

use Illuminate\Database\Seeder;
use App\customer_number_range;
class Customer_number_range_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('customer_number_range')->truncate();
        $data = [
            [1000000, 1999999],
        ];

        foreach ($data as $value) {
            customer_number_range::create([
                'start_range' => $value[0],
                'end_range' => $value[1],
                'company_id' => 0
            ]);
        }
    }
}
