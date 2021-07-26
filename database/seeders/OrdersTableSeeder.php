<?php

namespace Database\Seeders;

use App\Models\OrdenPurchases;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<40; $i++)
        {
            OrdenPurchases::create([
                'iduser' => random_int(2,5),
                // 'package_id' => random_int(1,3),
                'cantidad' => 1,
                'total' => random_int(1000,10000),
                'status' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

    }
}
