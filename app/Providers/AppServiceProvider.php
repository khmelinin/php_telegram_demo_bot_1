<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Longman\TelegramBot\Telegram;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Telegram::class, function ($app) {
            $bot_api_key  = config('telegram.bot_api_key');
            $bot_username = config('telegram.bot_username');
            $telegram = new \Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
            $telegram->addCommandsPath(app_path("Telegram/Commands"));
            \Longman\TelegramBot\Request::initialize($telegram);
            return $telegram;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
