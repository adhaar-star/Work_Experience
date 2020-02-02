<?php

use Illuminate\Database\Seeder;
use Braintree_Plan as Braintree_Plan;
use App\Models\Payment\Plan;
use App\Models\Payment\plan_features;

class SyncPlansSeeder extends Seeder {

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run() {
      Plan::truncate();
      // Get plans from Braintree
      $braintreePlans = Braintree_Plan::all();

      // Iterate through the plans while populating our table with the plan data
      foreach ($braintreePlans as $braintreePlan) {
         Plan::create([
             'name' => $braintreePlan->name,
             'slug' => str_slug($braintreePlan->name),
             'braintree_plan' => $braintreePlan->id,
             'cost' => $braintreePlan->price,
             'description' => $braintreePlan->description,
         ]);
         $admin = 1;
         $user = NULL;
         $project = 0;
         if ($braintreePlan->id == 'individual') {
            $user = 0;
            $project = 3;
         } elseif ($braintreePlan->id == 'economical') {
            $user = 1;
            $project = 10;
         } else if ($braintreePlan->id == 'small-business') {
            $user = 3;
         } else if ($braintreePlan->id == 'medium-business') {
            $user = 5;
         }

         plan_features::create([
             'plan_id' => $braintreePlan->id,
             'admin' => $admin,
             'user' => $user,
             'project' => $project,
         ]);
      }
   }

}
