<?php

use App\Models\User;
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
                'name' => 'Admin',
                'last_name' => 'HDLR',
                'fullname' => 'Admin HDLR',
                'email' => 'admin@hdlr.com',
                'admin' => '1',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 0,
                'status' => '1'
            ]);
            User::create([
                'name' => 'Eulin',
                'last_name' => 'Palma',
                'fullname' => 'Eulin Palma',
                'email' => 'eulinpalma@valdusoft.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 0,
                'status' => '1'
            ]);
            User::create([
                'name' => 'Leonardo',
                'last_name' => 'Guilarte',
                'fullname' => 'Leonardo Guilarte',
                'email' => 'leomiguel@valdusoft.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 0,
                'status' => '1'
            ]);
            User::create([
                'name' => 'Alexis',
                'last_name' => 'Valera',
                'fullname' => 'Alexis Valera',
                'email' => 'alexisvalera@valdusoft.com',
                'admin' => '0',
                'password' => Hash::make('12345678'),
                'whatsapp' => '23423423423432',
                'referred_id' => 0,
                'status' => '1'
            ]);

            for($i = 0; $i <= 25; $i++){
                User::create([
                    'name' => Str::random(5),
                    'last_name' => Str::random(5),
                    'fullname' => Str::random(5),
                    'email' => Str::random(5).'@valdusoft.com',
                    'admin' => '0',
                    'password' => Hash::make('12345678'),
                    'whatsapp' => '23423423423432',
                    'referred_id' => random_int(1,10),
                    'status' => '1'
                ]);
            }

        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }
}
