<?php

namespace App\Console;

use App\Http\Controllers\GraphicController;
use App\Http\Controllers\MeiController;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\SmsNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // Implement code to verify users and send alerts
            $users = User::all();

            foreach ($users as $user) {
                if ($user->alert === 'sms') {
                    // Send SMS to user
                    $smsNotification = app(SmsNotification::class);
                    $smsNotification->sendSms();
                } elseif ($user->alert === 'email') {
                    // Send email to user
                    $EmailNotification = app(EmailNotification::class);
                    $EmailNotification->sendEmail();
                }
            }
        })->monthlyOn(1, '00:00');
        

        $schedule->call(function () {
            $users = User::all();
    
            foreach ($users as $user) {
                $sumValuesInvoices = app(GraphicController::class)->sumValueAllInvoicesByYears(date('Y'));
                $totalBilling = app(MeiController::class)->recoverMaxValueMeiData();
    
                $limit = $totalBilling * 0.8;

                if ($totalBilling >= $limit) {
                    if ($user->alert === 'sms') {
                        // Send SMS to user
                        $smsNotification = app(SmsNotification::class);
                        $smsNotification->sendSms();
                    } elseif ($user->alert === 'email') {
                        // Send email to user
                        $EmailNotification = app(EmailNotification::class);
                        $EmailNotification->sendEmail();
                    }
                }
            }
        })->dailyAt('08:00');
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
