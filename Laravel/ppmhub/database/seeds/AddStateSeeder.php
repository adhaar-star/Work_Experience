<?php

use Illuminate\Database\Seeder;

use App\state;

class AddStateSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run() {
        DB::table('state')->delete();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $state = [
        ['state_name' => 'Andhra Pradesh', 'country_id' => 103],
        ['state_name' => 'Arunachal Pradesh', 'country_id' => 103],
        ['state_name' => 'Assam', 'country_id' => 103],
        ['state_name' => 'Bihar', 'country_id' => 103],
        ['state_name' => 'Chhattisgarh', 'country_id' => 103],
        ['state_name' => 'Goa', 'country_id' => 103],
        ['state_name' => 'Gujarat', 'country_id' => 103],
        ['state_name' => 'Haryana', 'country_id' => 103],
        ['state_name' => 'Himachal Pradesh', 'country_id' => 103],
        ['state_name' => 'Jammu and Kashmir', 'country_id' => 103],
        ['state_name' => 'Jharkhand', 'country_id' => 103],
        ['state_name' => 'Karnataka', 'country_id' => 103],
        ['state_name' => 'Kerala', 'country_id' => 103],
        ['state_name' => 'Madhya Pradesh', 'country_id' => 103],
        ['state_name' => 'Maharashtra', 'country_id' => 103],
        ['state_name' => 'Manipur', 'country_id' => 103],
        ['state_name' => 'Meghalaya', 'country_id' => 103],
        ['state_name' => 'Mizoram', 'country_id' => 103],
        ['state_name' => 'Nagaland', 'country_id' => 103],
        ['state_name' => 'Odisha', 'country_id' => 103],
        ['state_name' => 'Punjab', 'country_id' => 103],
        ['state_name' => 'Rajasthan', 'country_id' => 103],
        ['state_name' => 'Sikkim', 'country_id' => 103],
        ['state_name' => 'Tamil Nadu', 'country_id' => 103],
        ['state_name' => 'Telangana', 'country_id' => 103],
        ['state_name' => 'Uttar Pradesh', 'country_id' => 103],
        ['state_name' => 'Uttarakhand', 'country_id' => 103],
        ['state_name' => 'West Bengal', 'country_id' => 103],
        ['state_name' => 'Andaman and Nicobar Islands', 'country_id' => 103],
        ['state_name' => 'Chandigarh', 'country_id' => 103],
        ['state_name' => 'Dadra and Nagar Haveli', 'country_id' => 103],
        ['state_name' => 'Daman and Diu', 'country_id' => 103],
        ['state_name' => 'Lakshadweep', 'country_id' => 103],
        ['state_name' => 'National Capital Territory of Delhi', 'country_id' => 103],
        ['state_name' => 'Puducherry', 'country_id' => 103],
            
        ['state_name' => 'Australian Capital Territory', 'country_id' => 14],
        ['state_name' => 'New South Wales', 'country_id' => 14],
        ['state_name' => 'Northern Territory', 'country_id' => 14],
        ['state_name' => 'Queensland', 'country_id' => 14],
        ['state_name' => 'South Australia', 'country_id' => 14],
        ['state_name' => 'Tasmania', 'country_id' => 14],
        ['state_name' => 'Victoria', 'country_id' => 14],
        ['state_name' => ' Western Australia', 'country_id' => 14],
        ];
        
         foreach ($state as $state_data) {
            state::create($state_data);
        }
          
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
