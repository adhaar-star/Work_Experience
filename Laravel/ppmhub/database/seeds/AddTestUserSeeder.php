<?php

use Illuminate\Database\Seeder;
use App\register;

class AddTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            'name' => 'usertest',
            'lname' => 'test',
            'email' => 'test@test.com',
            'password' => crypt("123456", ""),
            'phone' => '9999999999',
            'role_id' => '2',
            'status' => 'active',
            'verify_code' => '12345',
            'is_deleted' => 'No',
            'company_id' => 0
        );
        register::create($user);
    }
}
