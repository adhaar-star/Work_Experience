<?php

namespace App\Console;

use App\Console\Commands\CreateBilling;
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
        '\App\Console\Commands\RunProgressCalculations',
        CreateBilling::class,
        Commands\SyncPlans::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('RunProgressCalculations:runprogresscalculation')
                ->dailyAt('09:00')	
                ->sendOutputTo('laravelCron.log');


        $schedule->command('CreateBilling')->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

}
