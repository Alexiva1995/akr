<?php

use Illuminate\Database\Seeder;
use Database\Seeders\CountriesTableSeederr;
use Database\Seeders\OrdersTableSeeder;
use Database\Seeders\RanksSeeder;
use Database\Seeders\WalletTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeederr::class);
        $this->call(UserTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(WalletTableSeeder::class);
        $this->call(RanksSeeder::class);
    }
}
