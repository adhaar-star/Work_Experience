<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
		[
            ['name' => 'admin','email' => 'admin@gmail.com','password' => crypt("admin", ""),'lname' => 'admin',          'phone' => '0987896758','role_id' => '1','status' => 'active','verify_code' => '12345','is_deleted' => 'No'],
		   ['name' => 'Test','email' => 'user@gmail.com','password' => crypt("admin", ""),'lname' => 'User','phone' => '0123456789','role_id' => '3','status' => 'active','verify_code' => '12345','is_deleted' => 'No'],
		   ['name' => 'Test Two','email' => 'user_two@gmail.com','password' => crypt("admin", ""),'lname' => 'User','phone' => '0123456789','role_id' => '3','status' => 'active','verify_code' => '12345','is_deleted' => 'No'],
		   ['name' => 'Test Three','email' => 'user_three@gmail.com','password' => crypt("admin", ""),'lname' => 'User','phone' => '0123456789','role_id' => '3','status' => 'active','verify_code' => '12345','is_deleted' => 'No']
        ]
		);
    }
}
