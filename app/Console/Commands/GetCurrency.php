<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use XmlParser;
use Storage;

class GetCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Daily Currency';

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
     * @return mixed
     */
    public function handle()
    {
        $this->convertAmount();
    }

    public function convertAmount(){
        $xml = XmlParser::load('http://www.bnm.org/ro/official_exchange_rates?get_xml=1&date='.date("d.m.Y"));

        $parsed = $xml->parse([
            'cursToDay' => ['uses' => 'Valute[CharCode,Value]'],
        ]);

        $currency = array('EUR','USD');
        $json = array();
        foreach ($parsed as $key => $item) {
            foreach ($item as $key => $val) {
                if (in_array($val['CharCode'], $currency)) {
                    $json[$val['CharCode']] = $val['Value'];
                }
            }
        }
        $put = Storage::put('json_currency.json', json_encode($json));
    }
}
