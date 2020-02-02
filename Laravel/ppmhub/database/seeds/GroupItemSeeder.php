<?php

use Illuminate\Database\Seeder;

class GroupItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('group')->truncate();
        $data = [
            ['Resource costs'],
            ['Material costs'],
            ['Actual costs'],
            ['Forecast'],
            ['Commitment'],
            ['Revenue'],
            ['Budget'],
        ];

        foreach ($data as $value) {
            App\group::create([
                'group_name' => $value[0],
                'company_id' => 0,
            ]);
        }
    }
}
