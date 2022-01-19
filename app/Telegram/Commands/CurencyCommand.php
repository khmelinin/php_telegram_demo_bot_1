<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\Entities;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Message;
use Longman\TelegramBot\Request;

class CurencyCommand extends UserCommand
{
    protected $name = 'curency';                      // Your command's name
    protected $description = 'A command for curency'; // Your command description
    protected $usage = '/curency';                    // Usage of your command
    protected $version = '1.0.0';                  // Version of your command

    private function get_currency() {

        $uah = 0;
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));
        if (!empty($xml)) {
            foreach ($xml->Valute as $item) {
                if ($item['ID'] == 'R01720') {
                    $uah = $item->Value;
                }
            }
            if (!empty($uah)) {
                $uah = str_replace(',', '.', $uah);
            }
        }
        return $uah;
    }

    public function execute()
    {
        /** @var Message $message */

        $chat_id = $this->getMessage()->getChat()->getId();   // Get the current Chat ID

        //$text = $message->getText(true);
        $data = [                                  // Set up the new message data
            'chat_id' => $chat_id,                 // Set Chat ID to send the message to
            'text'    => (string)$this->get_currency(), // Set message to send
        ];

        return Request::sendMessage($data);        // Send message!
    }
}
