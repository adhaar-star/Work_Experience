<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RoleAuthSeeder::class);
        $this->call(AddUserSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(AddStateSeeder::class);
        $this->call(IssueTypeSeeder::class);
        $this->call(QualitativeRiskMatrix::class);
        $this->call(QuantitativeRiskScore::class);
        $this->call(InquiryNumberRangeSeeder::class);
        $this->call(QuotationNumberRangeSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(GroupItemSeeder::class);
        $this->call(ViewItemSeeder::class);
        $this->call(SalesOrderRangeSeeder::class);
        $this->call(Customer_number_range_Seeder::class);
        $this->call(ProjectNumberRangeTableSeeder::class);
        $this->call(CommonRoutesSeeder::class);
        $this->call(MasterRangeNumberSeeder::class);
        $this->call(SyncPlansSeeder::class);
    }

}
