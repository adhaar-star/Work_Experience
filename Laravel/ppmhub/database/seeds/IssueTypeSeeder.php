<?php

use Illuminate\Database\Seeder;
use App\IssueType;

class IssueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('issuetype')->truncate();
          
          $mult=array('Design','planning', 'project management', 'construction', 'procurement', 'sales', 'Financial', 'commissioning');
          
          foreach($mult as $multData)
          {
              
          $IssueTypeAdd = array('name' => $multData);
          IssueType::create($IssueTypeAdd);
              
          }
        
    }
}
