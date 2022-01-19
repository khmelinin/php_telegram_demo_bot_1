<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        echo $this->get_currency();
        return 0;
    }

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
}
