<?php

namespace App\Console\Commands;

use App\Http\Controllers\WalletController;
use Illuminate\Console\Command;

class BinaryBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binary:bonus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permite agregar los diferentes bonos binarios cada día a la 00:00';

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
        $walletControler = new WalletController();
        $walletControler->payPointsBinary();
    }
}
