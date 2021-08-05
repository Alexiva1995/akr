<?php

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
                'country_id' => '237',
                'status' => '1',
                'email_verified_at' => Carbon::now(),
                'referred_id' => 0,
                'binary_id' => 0,
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
                'country_id' => '237',
                'status' => '1',
                'email_verified_at' => Carbon::now(),
                'referred_id' => 1,
                'binary_id' => 1,
                'binary_side' => 'I',
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
                'country_id' => '237',
                'status' => '0',
                'email_verified_at' => Carbon::now(),
                'referred_id' => 2,
                'binary_id' => 2,
                'binary_side' => 'I',
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
                'country_id' => '237',
                'status' => '0',
                'email_verified_at' => Carbon::now(),
                'referred_id' => 2,
                'binary_id' => 2,
                'binary_side' => 'D',

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
                'country_id' => '237',
                'status' => '0',
                'email_verified_at' => Carbon::now(),
                'referred_id' => '2',
                'binary_id' => '3',
                'binary_side' => 'D',
            ]);


        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
