<?php

use App\Models\OrdenPurchases;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            User::create([
                // ID => 1
                'name' => 'Admin',
                'last_name' => 'HDLR',
                'fullname' => 'Admin HDLR',
                'email' => 'admin@email.com',
                'admin' => '1',
                'password' => Hash::make('12password'),
                'whatsapp' => '23423423423432',
                'referred_id' => '0',
                'country_id' => '237',
                'status' => '1',
                'binary_id' => '0',
            ]);
            User::create([
                // ID => 2
                'name' => 'Leonardo',
                'last_name' => 'Guilarte',
                'fullname' => 'Leonardo Guilarte',
                'email' => 'user@email.com',
                'admin' => '0',
                'password' => Hash::make('12password'),
                'whatsapp' => '23423423423432',
                'referred_id' => '1',
                'country_id' => '237',
                'status' => '1',
                'binary_side' => 'I'
            ]);
            User::create([
                // ID => 3
                'name' => 'Juan',
                'last_name' => 'Rojas',
                'fullname' => 'Juan Rojas',
                'email' => 'test@email.com',
                'admin' => '0',
                'password' => Hash::make('12password'),
                'whatsapp' => '23423423423432',
                'referred_id' => '2',
                'country_id' => '237',
                'binary_id' => '2',
                'status' => '1',
                'binary_side' => 'I'
            ]);            
            User::create([
                // ID => 4
                'name' => 'Eulin',
                'last_name' => 'Palma',
                'fullname' => 'Eulin Palma',
                'email' => 'eulinpalma@valdusoft.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => '2',
                'country_id' => '237',
                'status' => '1'
            ]);
            User::create([
                // ID => 5
                'name' => 'Alexis',
                'last_name' => 'Valera',
                'fullname' => 'Alexis Valera',
                'email' => 'alexisvalera@valdusoft.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => '2',
                'country_id' => '237',
                'status' => '1'
            ]);

            // for($i = 0; $i<50; $i++)
            // {
            //     OrdenPurchases::create([
            //         'iduser' => random_int(2,5),
            //         // 'package_id' => random_int(1,3),
            //         'cantidad' => 1,
            //         'total' => random_int(1000,10000),
            //         'status' => '0',
            //         'created_at' => Carbon::now(),
            //         'updated_at' => Carbon::now()
            //     ]);
            // }


        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
