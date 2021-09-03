<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generar Comisiones user
        for($i = 1; $i < 10; $i++){
            Wallet::create([
                'iduser' => 3,
                'referred_id' => 2,
                'monto' => random_int(50,100),
                'descripcion' => 'Bono Directo por el usuario USUARIO',
                'status' => random_int(0,1),
                'tipo_transaction' => 0,
                'liquidado' => 0,
            ]);
        }
    }
}
