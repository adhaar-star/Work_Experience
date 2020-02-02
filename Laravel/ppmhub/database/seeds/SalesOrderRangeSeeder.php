<?php

use Illuminate\Database\Seeder;

class SalesOrderRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
      public function run() {
        DB::table('salesOrderNumber_range')->truncate();
        $data = [
            [3000000, 3999999],
        ];

        foreach ($data as $value) {
            App\salesOrderRange::create([
                'start_range' => $value[0],
                'end_range' => $value[1],
                'company_id' => 0
            ]);
        }
    }
}
