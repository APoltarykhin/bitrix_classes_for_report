<?php
namespace App\Jobs;

use Carbon\Carbon;
use App\Services\IntegrationLogger;
use App\Mail\IntegrationReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ExchangeServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {

        $now = Carbon::now();


        $sendTime = $now->copy()->setHour(10)->setMinute(0)->setSecond(0);


        if ($now->greaterThanOrEqualTo($sendTime)) {

            $integrationLogger = new IntegrationLogger();
            $report = $integrationLogger->generateReport();

            $recipients = ['user1@example.com', 'user2@example.com'];
            $subject = 'Отчет о процессе интеграции';
            $mail = new IntegrationReport($report);
            Mail::to($recipients)->send($mail);
        }
    }
}