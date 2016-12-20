<?php

namespace App\Console;

use App\Console\Commands\SyncHashTagsCountCommand;
use App\Console\Commands\TwitterGetDataCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TwitterGetDataCommand::class,
        SyncHashTagsCountCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('twitter:get')->everyThirtyMinutes();
        $schedule->command('twitter:sync')->hourly();
    }
}
