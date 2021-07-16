<?php

use Illuminate\Database\Seeder;
// use Database\Seeders\PackagesTableSeeder;
// use Database\Seeders\OrdenPurchaseSeeder;
use App\Models\OrdenPurchases;
use App\Models\Packages;
use App\Models\Groups;
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

        Groups::create([
            "name" => "Grupo 1",
            "status" => "1",
            "email" => "grupo1@email.com",
            "ganacia" => "10000",
            "progreso" => "10",
            "package" => "4",
        ]);

        // $arrayPackage = [
            
        //     [
        //       "id"=>"1",
        //       "name"=>"Paquete A",
        //       "price"=>"50",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"2",
        //       "name"=>"Paquete B",
        //       "price"=>"100",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"3",
        //       "name"=>"Paquete C",
        //       "price"=>"300",
        //       "group_id" => "1"
        //     ],
        //      [
        //       "id"=>"4",
        //       "name"=>"Paquete D",
        //       "price"=>"500",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"5",
        //       "name"=>"Paquete E",
        //       "price"=>"1000",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"6",
        //       "name"=>"Paquete F",
        //       "price"=>"2000",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"7",
        //       "name"=>"Paquete G",
        //       "price"=>"3000",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"8",
        //       "name"=>"Paquete H",
        //       "price"=>"5000",
        //       "group_id" => "1"
        //     ],
        //     [
        //       "id"=>"9",
        //       "name"=>"Paquete I",
        //       "price"=>"10000",
        //       "group_id" => "1"
        //     ],
          
        // ];
        // foreach ($arrayPackage as $package ) {
        //     Packages::create($package);
        // }

        // for($i = 0; $i<20; $i++)
        // {
        //     OrdenPurchases::create([
        //         'iduser' => random_int(1,3),
        //         'package_id' => random_int(1,2),
        //         'cantidad' => 1,
        //         'total' => random_int(1000,10000),
        //         'status' => '0',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }

    }
}
