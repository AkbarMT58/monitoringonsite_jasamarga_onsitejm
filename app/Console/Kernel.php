<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         // Backup setiap jam 2 pagi

         
        // Format it for a custom backup file name
        //$backupName = 'backup-' . now()->format('Y-m-d_H-i-s') . '.zip';

        $schedule->call(function () {
            $backupController = new \App\Http\Controllers\Dashboard\DatabaseManagementController();
            $backupController->scheduledBackup();
        })->dailyAt('13:50')->timezone('Asia/Jakarta');
        
        // dailyAt('14:00')->timezone('Asia/Jakarta');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
