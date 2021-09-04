<?php

namespace App\Console\Commands;

use App\Http\Controllers\WalletController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyBonuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:bonuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite agregar el sistema de puntos binarios y el Bono directo cada diez minutos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Log::info('Inicio de los puntos y comisiones diarias - '.Carbon::now());
            $walletControler = new WalletController();
            $walletControler->payAll();

            // $users = User::all()->where('status', '1');

            // foreach($users as $user){
            //     Log::info('Usuarios para getTotalPoints - '.$user->id);
            //     $walletControler->getTotalPoints($user->id);
            // }
            

            Log::info('Fin de los puntos y comisiones diarias - '.Carbon::now());
        } catch (\Throwable $th) {
            Log::error('Error Cron Binario -> '.$th);
        }
    }
}
