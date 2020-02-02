<?php

use Illuminate\Database\Seeder;
use App\Quantitative_riskscore;

class QuantitativeRiskScore extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('quantitative_riskscore')->truncate();
        $data = [
            [1,1900,1, 'Insignificant'],
            [2000,19000,2, 'Minor'],
            [20000,99999,3, 'Moderate'],
            [100000,499999,4, 'Serious'],
            [500000,99999999999,5, 'Very serious'],
           
        ];

        foreach ($data as $value) {
            Quantitative_riskscore::create([
                'start_range' => $value[0],
                'end_range' => $value[1],
                'risk_value' => $value[2],
                'risk_status' => $value[3],
                'company_id' => 0
            ]);
        }
    }
}
