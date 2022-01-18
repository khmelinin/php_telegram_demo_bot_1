<?php

namespace App\Http\Controllers;

use Longman\TelegramBot\Telegram;

class TelegramController extends Controller
{
    public function handle(Telegram $telegram) {
        $telegram->handle();
    }
}
