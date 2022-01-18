<?php

return [
    "bot_api_key"  => env('TELEGRAM_API_KEY', ''),
    "bot_username" => env('TELEGRAM_USERNAME', ''),
    "hook_url"     => env('TELEGRAM_WEBHOOK', '/api/telegram/hook'),
];
