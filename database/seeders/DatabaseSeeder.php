<?php

use Illuminate\Database\Seeder;
// use Database\Seeders\PackagesTableSeeder;
// use Database\Seeders\OrdenPurchaseSeeder;
use App\Models\Packages;
use App\Models\OrdenPurchases;
use Carbon\Carbon;


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
        $this->call(UserTableSeeder::class);
        // $this->call(OrdenPurchasesSeeder::class);
        // $this->call(PackagesTableSeeder::class);
        // $this->call(CountryTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(ServicesTableSeeder::class);
        // $this->call(TimeZoneTableSeeder::class);
        // $this->call(AddSaldoTableSeeder::class);
        // $this->call(WalletTableSeeder::class);

        $date = Carbon::now(); 
        $expired = $date->addYear();  

        $arrayPackage = [            
            [
            "id"=>"1",
            "name"=>"Paquete A",
            "price"=>"50",
            "expired" => $expired
            ],
            [
            "id"=>"2",
            "name"=>"Paquete B",
            "price"=>"100",
            "expired" => $expired
            ],
            [
            "id"=>"3",
            "name"=>"Paquete C",
            "price"=>"300",
            "expired" => $expired
            ],
            [
            "id"=>"4",
            "name"=>"Paquete D",
            "price"=>"500",
            "expired" => $expired
            ],
            [
            "id"=>"5",
            "name"=>"Paquete E",
            "price"=>"1000",
            "expired" => $expired
            ],
            [
            "id"=>"6",
            "name"=>"Paquete F",
            "price"=>"2000",
            "expired" => $expired
            ],
            [
            "id"=>"7",
            "name"=>"Paquete G",
            "price"=>"3000",
            "expired" => $expired
            ],
            [
            "id"=>"8",
            "name"=>"Paquete H",
            "price"=>"5000",
            "expired" => $expired
            ],
            [
            "id"=>"9",
            "name"=>"Paquete I",
            "price"=>"10000",
            "expired" => $expired
            ],
          
        ];
        foreach ($arrayPackage as $package ) {
            Packages::create($package);
        }

        for($i = 0; $i<20; $i++)
        {
            OrdenPurchases::create([
                'iduser' => random_int(1,3),
                'package_id' => random_int(1,3),
                'cantidad' => 1,
                'total' => random_int(1000,10000),
                'status' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

    }
}
