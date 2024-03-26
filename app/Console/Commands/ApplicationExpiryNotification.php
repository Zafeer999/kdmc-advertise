<?php

namespace App\Console\Commands;

use App\Factories\SmsProviderFactory;
use App\Models\HoardingPermission;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ApplicationExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:expiry-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $smsProvider = SmsProviderFactory::get('aditya');

        HoardingPermission::
            whereDate('to_date', Carbon::today()->toDateString())
            ->orderByDesc('id')
            ->chunk(100, function($applications) use ($smsProvider){
                foreach($applications as $application)
                {
                    $application->load('user');

                    $smsProvider->applicationExpirySms($application->user?->mobile, $application);
                }
            });


        $this->info('Command executed successfully');
    }
}
