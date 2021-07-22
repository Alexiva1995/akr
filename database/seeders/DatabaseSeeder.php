<?php

use Illuminate\Database\Seeder;
// use Database\Seeders\PackagesTableSeeder;
// use Database\Seeders\OrdenPurchaseSeeder;
use App\Models\Packages;
use App\Models\OrdenPurchases;
use Carbon\Carbon;
use Database\Seeders\CountriesTableSeederr;

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
        // $this->call(OrdenPurchasesSeeder::class);
        // $this->call(PackagesTableSeeder::class);
        // $this->call(CountryTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(ServicesTableSeeder::class);
        // $this->call(TimeZoneTableSeeder::class);
        // $this->call(AddSaldoTableSeeder::class);
        // $this->call(WalletTableSeeder::class);

        // $date = Carbon::now(); 
        // $expired = $date->addYear();  

        // for($i = 0; $i<20; $i++)
        // {
        //     OrdenPurchases::create([
        //         'iduser' => random_int(1,3),
        //         'package_id' => random_int(1,3),
        //         'cantidad' => 1,
        //         'total' => random_int(1000,10000),
        //         'status' => '0',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    }
}
