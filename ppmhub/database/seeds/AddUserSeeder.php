<?php

use Illuminate\Database\Seeder;
use App\register;
// use App\role;

class AddUserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //seed for role


        // DB::table('roles')->truncate();
        // $user_role = [
        //     ['type' => 'Administrator', 'is_admin' => 'Y'],
        //     ['type' => 'Admin Portfolio Manager', 'is_admin' => 'Y'],
        //     ['type' => 'Admin Project Team Member', 'is_admin' => 'Y'],
        //     ['type' => 'Role 1', 'is_admin' => 'N'],
        //     ['type' => 'Role 2', 'is_admin' => 'N'],
        //     ['type' => 'Role 3', 'is_admin' => 'N'],
        //     ['type' => 'Role 4', 'is_admin' => 'N'],
        //     ['type' => 'Role 5', 'is_admin' => 'N'],
        // ];
        // foreach ($user_role as $user) {
        //     Role::create($user);
        // }


        //seed for user
        DB::table('users')->truncate();
        $user = array(
            'name' => 'admin',
            'lname' => 'admin',
            'email' => 'admin@admin.com',
            'password' => crypt("#Hub2017", ""),
            'phone' => '0987896758',
            'role_id' => '2',
            'status' => 'active',
            'verify_code' => '12345',
            'is_deleted' => 'No',
            'company_id' => 0
        );
        register::create($user);
    }

}
