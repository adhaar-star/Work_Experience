<?php

use Illuminate\Database\Seeder;

class ViewItemSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('view')->truncate();
        $data = [
            ['Plan cost'],
            ['Forecast costs'],
            ['Actual cost'],
            ['Commitment'],
            ['Planned revenue'],
            ['Forecast revenue'],
            ['Actual revenue'],
            ['Budget'],
        ];

        foreach ($data as $value) {
            App\view::create([
                'view_name' => $value[0],
                'company_id' => 0,
            ]);
        }
    }

}
