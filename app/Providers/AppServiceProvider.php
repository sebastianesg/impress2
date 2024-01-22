<?php

namespace App\Providers;

use App\Models\ExtraVariable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable('extra_variables')){
            $settings = ExtraVariable::where('module', 1)->pluck('value', 'name');

            if (isset($settings['SMAIL_HOST'])){
                $mailConfig = [
                    'transport' => 'smtp',
                    'host' => $settings['SMAIL_HOST'],
                    'port' => $settings['SMAIL_PORT'],
                    'encryption' => $settings['SMAIL_SECURE'],
                    'username' => $settings['SMAIL_USERNAME'],
                    'password' => $settings['SMAIL_PASSWORD'],
                    'timeout' => null,
                    'from' => array('address' => $settings['SMAIL_EMAIL'], 'name' => $settings['SMAIL_FROM']),
                ];
                config(['mail.mailers.smtp' => $mailConfig]);
            }
        }

    }
}
