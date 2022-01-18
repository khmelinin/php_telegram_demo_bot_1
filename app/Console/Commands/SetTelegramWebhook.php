<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Longman\TelegramBot\Telegram;

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

    protected $telegram;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hook_url     = config('app.url').config('telegram.hook_url');
        // Set webhook
        $this->info($hook_url);
        $result = $this->telegram->setWebhook($hook_url);
        if ($result->isOk()) {
            echo $result->getDescription();
        } else {
            $this->error("Some error happened!");
            dd($result);
        }
        return 0;
    }
}
