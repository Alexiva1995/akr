<?php

use Illuminate\Database\Seeder;
use Database\Seeders\CountriesTableSeederr;
// use Database\Seeders\OrdersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        $this->call(CountriesTableSeederr::class);
        $this->call(UserTableSeeder::class);
        // $this->call(OrdersTableSeeder::class);
        // $this->call(OrdenPurchasesSeeder::class);
        // $this->call(PackagesTableSeeder::class);
        // $this->call(CountryTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(ServicesTableSeeder::class);
        // $this->call(TimeZoneTableSeeder::class);
        // $this->call(AddSaldoTableSeeder::class);
        // $this->call(WalletTableSeeder::class);
    }
}
