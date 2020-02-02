<?php

use Illuminate\Database\Seeder;

class MasterRangeNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i= 1; $i<50; $i++){
            \App\Models\Master\RangeNumber::create(
                [
                    'company_id' => 0,
                    'start'      => 10000 * $i,
                    'end'        => 900000,
                    'model'      => $i,
                ]
            );

        }

    }
}
