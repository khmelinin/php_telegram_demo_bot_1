<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetTelegramWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:set-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set telegram bot webhook url';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bot_api_key  = '5035919556:AAFs5kgaiJ-k-UhMCbOjfQS4H0RDEJuJOIM';
        $bot_username = 'php_group_demo_bot';
        $hook_url     = 'https://b459-80-64-86-179.ngrok.io/api/telegram/hook';

        try {
            // Create Telegram API object
            $telegram = new \Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

            // Set webhook
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                echo $result->getDescription();
            } else {
                $this->error("Some error happened!");
                dd($result);
            }
        } catch (\Longman\TelegramBot\Exception\TelegramException $e) {
            $this->error("Some error happened!");
            dd($e->getMessage());
            // log telegram errors
            // echo $e->getMessage();
        }
        return 0;
    }
}
