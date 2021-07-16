<?php

namespace Database\Seeders;

use App\Models\OrdenPurchases;
use Illuminate\Database\Seeder;

class OrdenPurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<20; $i++)
        {
            OrdenPurchases::create([
                'iduser' => random_int(1,3),
                'package_id' => random_int(1,2),
                'cantidad' => 1,
                'total' => random_int(1000,10000),
                'status' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }   
    }
}
