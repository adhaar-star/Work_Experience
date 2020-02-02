<?php

use Illuminate\Database\Seeder;
use App\QualitativeMatrix;

class QualitativeRiskMatrix extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('qualitative_matrix')->truncate();
        $matrixData = [
            ['Rare', 'Catastrophic', 5, 'Medium'],
            ['Unlikely', 'Catastrophic', 10, 'Medium'],
            ['Possible', 'Catastrophic', 15, 'High'],
            ['Likely', 'Catastrophic', 20, 'High'],
            ['Almost certain', 'Catastrophic', 25, 'High'],
            ['Rare', 'Major', 4, 'Medium'],
            ['Unlikely', 'Major', 8, 'Medium'],
            ['Possible', 'Major', 12, 'Medium'],
            ['Likely', 'Major', 16, 'High'],
            ['Almost certain', 'Major', 20, 'High'],
            ['Rare', 'Moderate', 3, 'Low'],
            ['Unlikely', 'Moderate', 6, 'Medium'],
            ['Possible', 'Moderate', 9, 'Medium'],
            ['Likely', 'Moderate', 12, 'Medium'],
            ['Almost certain', 'Moderate', 15, 'High'],
            ['Rare', 'Minor', 2, 'Low'],
            ['Unlikely', 'Minor', 4, 'Medium'],
            ['Possible', 'Minor', 6, 'Medium'],
            ['Likely', 'Minor', 8, 'Medium'],
            ['Almost certain', 'Minor', 10, 'Medium'],
            ['Rare', 'Negligible', 1, 'Low'],
            ['Unlikely', 'Negligible', 2, 'Low'],
            ['Possible', 'Negligible', 3, 'Low'],
            ['Likely', 'Negligible', 4, 'Medium'],
            ['Almost certain', 'Negligible', 5, 'Medium'],
        ];

        foreach ($matrixData as $value) {
            QualitativeMatrix::create([
                'qualitative_likelihood' => $value[0],
                'qualitative_consequence' => $value[1],
                'risk_value' => $value[2],
                'risk_score' => $value[3],
                'company_id' => 0
            ]);
        }
    }

}
