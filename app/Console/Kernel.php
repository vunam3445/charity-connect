<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdateEventStatus::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('events:update-status')->dailyAt('00:10')->timezone('Asia/Ho_Chi_Minh');

    }

protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
