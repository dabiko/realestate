<?php

namespace App\Providers;

use App\Models\MailSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('mail_settings')){

            $emailSettings = MailSettings::first();

            if ($emailSettings){
                $data = [
                    'driver' => $emailSettings->mailer,
                    'host' => $emailSettings->host,
                    'port' => $emailSettings->port,
                    'username' => $emailSettings->username,
                    'password' => $emailSettings->password,
                    'encryption' => $emailSettings->encryption,
                    'from' => [
                        'address' => $emailSettings->from_address,
                        'name' => 'Homes'
                    ],
                ];

                Config::set('mail', $data);
            }
        }
    }
}
