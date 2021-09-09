<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DailyBonuses::class,
        Commands\PagarUtilidad::class,
        Commands\BinaryBonus::class,
        Commands\CheckRank::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Los comandos de producción
        $schedule->command('binary:bonus')->everyTenMinutes();
        $schedule->command('daily:bonuses')->daily();
        $schedule->command('pagar:utilidad')->weekdays()->daily();
        $schedule->command('check:rank')->daily();


        //  Comandos para pruebas en desarrollo
        // $schedule->command('binary:bonus')->everyMinute();
        // $schedule->command('daily:bonuses')->everyMinute();
        // $schedule->command('pagar:utilidad')->everyMinute();
        // $schedule->command('check:rank')->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
