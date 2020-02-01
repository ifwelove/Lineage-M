<?php

namespace App\Console;

use App\Console\Commands\DedicateDataCommand;
use App\Console\Commands\MoveHtmlCommand;
use App\Console\Commands\PastDataCommand;
use App\Console\Commands\PushHtmlCommand;
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
        PushHtmlCommand::class,
        DedicateDataCommand::class,
        PastDataCommand::class,
        MoveHtmlCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
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
