<?php

use Illuminate\Database\Seeder;
use App\ProjectNumberRange;

class ProjectNumberRangeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_number_range')->truncate();
        ProjectNumberRange::create(['start_range' => 00001, 'end_range' => 10000, 'company_id' => 0]);
    }
}
