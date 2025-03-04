<?php

namespace App\Providers;

use App\Models\Setting;
use Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CustomMailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mailSetting = Cache::rememberForever('mail_settings', function(){
            $key = [
                'mail_driver',
                'mail_host',
                'mail_port',
                'mail_username',
                'mail_password',
                'mail_encryption',
                'mail_from_address',
                'mail_receive_address'
            ];
            return Setting::whereIn('key', $key)->pluck('value', 'key')->toArray();
        });

        if($mailSetting){
            Config::set('mail.mailers.smtp.host', $mailSetting['mail_host']);
            Config::set('mail.mailers.smtp.port', $mailSetting['mail_port']);
            Config::set('mail.mailers.smtp.username', $mailSetting['mail_username']);
            Config::set('mail.mailers.smtp.password', $mailSetting['mail_password']);
            Config::set('mail.mailers.smtp.encryption', $mailSetting['mail_encryption']);
            Config::set('mail.from.address', $mailSetting['mail_from_address']);
        }
    }
}
