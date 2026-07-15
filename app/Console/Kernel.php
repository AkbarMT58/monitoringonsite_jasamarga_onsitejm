<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Http\Controllers\Dashboard\DatabaseManagementController;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
         
        // $schedule->call(function () {
        //     $backupController = new \App\Http\Controllers\Dashboard\DatabaseManagementController();
        //     $backupController->scheduledBackup();
        // })->dailyAt('15:28')->timezone('Asia/Jakarta')
        //  ->appendOutputTo(storage_path('logs/backup_onsite.log'));


          $schedule->call(function () {
            $controller = app(DatabaseManagementController::class); 
            // Resolve from container
            $controller->scheduledBackup();      
           
       // Execute the function
        })->everyMinute(); // Set your preferred frequenc

        //  dd($schedule);

     
  
       
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
