<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::any("/telegram/hook", function (Request $request) {
   $chatId = $request->input("message.chat.id");
   $text = $request->input("message.text");

    $bot_api_key  = '5035919556:AAFs5kgaiJ-k-UhMCbOjfQS4H0RDEJuJOIM';
    $bot_username = 'php_group_demo_bot';
    $telegram = new \Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    \Longman\TelegramBot\Request::initialize($telegram);

    $result = \Longman\TelegramBot\Request::sendMessage([
        'chat_id' => $chatId,
        'text'    => 'bot: your request text was: '.$text,
    ]);

   return [
       "chat_id" => $chatId,
       "text" => $text
   ];
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
