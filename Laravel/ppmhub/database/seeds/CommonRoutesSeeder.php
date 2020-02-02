<?php

use Illuminate\Database\Seeder;
use App\common_route_master;
use App\roles_master;

class CommonRoutesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('common_route_masters')->truncate();
        $json = File::get("database/data/common_routes.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            $pid = common_route_master::create(array(
                        'route_path' => $obj->name,
                        'parent' => 0
            ));
            if (isset($obj->children)) {
                $this->recursive($obj->children, $pid->id);
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $all_routes = common_route_master::select('id')->orderBy('id', 'asc')->get()->pluck('id');        
        $all_company_admins = roles_master::where('role_name', 'Company Admin')->get();
        foreach ($all_company_admins as $companyAdmin) {

            $companyAdmin->routes()->sync($all_routes); // attach new rows & delete old non required rows
        }
    }

    public function recursive($data, $parent)
    {
        foreach ($data as $obj) {
            $pid = common_route_master::create(array(
                        'route_path' => $obj->name,
                        'parent' => $parent
            ));
            if (isset($obj->children)) {
                $this->recursive($obj->children, $pid->id);
            }
        }
    }
}