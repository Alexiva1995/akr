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
        //
        // Commands\CambiarStatusInversion::class,
        // Commands\ReinvertirCapital::class,
        // Commands\PagarUtilidadFinMes::class
        //'App\Console\Commands\CambiarStatusInversion'
        Commands\DailyBonuses::class,
        Commands\PagarUtilidad::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('status:inversion')->daily();
        // $schedule->command('reinvertir:capital')->daily();
        $schedule->command('daily:bonuses')->everyTenMinutes();
        $schedule->command('pagar:utilidad')->weekdays()->daily(); // de lunes a viernes
        $schedule->command('binary:bonus')->daily();
        //$schedule->command('status:inversion')->everyMinute();
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
