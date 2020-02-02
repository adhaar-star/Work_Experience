<?php

use Illuminate\Database\Seeder;
use App\category;
use Illuminate\Support\Facades\Auth;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('category')->truncate();
        $data = [
            ['Capital'],
            ['Opex'],
        ];

        foreach ($data as $value) {
            category::create([
                'category_name' => $value[0],
                'company_id' => 0,
            ]);
        }
    }

}
