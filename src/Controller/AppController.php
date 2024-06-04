<?php

namespace App\Controller;
use App\Service\Helper;
use App\Entity\UserAgents;
use App\Factory\BinFactory;
use App\Factory\ExchangeFactory;
use App\Factory\ConfigBinFactory;
use App\Factory\ConfigExchangeFactory;
use App\Service\ApiConnection;
use App\Service\CommissionCalculation;

class AppController
{
    public $dto_configs;
    public $dto_bin_configs;
    public $api_exchange_configs;
    
    public function __construct(object $dto_configs)
    {
        $this->dto_configs = $dto_configs;
        //print_r($dto_configs);
        $this->dto_bin_configs = ConfigBinFactory::create($dto_configs);
        $this->api_exchange_configs = ConfigExchangeFactory::create($dto_configs);
    }
   
    public function index(string $file_with_data): array
    {
        $result = [];
        $result["error"] = "";
        $commission = [];
        //$random_user_agent = UserAgents::randomValue();
        $rows_from_file = Helper::getArrayOfObject($file_with_data);
    
        $api_connection = new ApiConnection($this->dto_bin_configs, $this->api_exchange_configs);

        /*receive exchange rates*/
       
        $api_exchange_rate = $api_connection->getCurrenciesExchangeList(
            $this->api_exchange_configs
        );
        
        $exchange_provider = ExchangeFactory::create($this->dto_configs->exchange_url_type);
        $exchange_rate = $exchange_provider->getExchangeRates($api_exchange_rate);
        
        $calculation = new CommissionCalculation($this->dto_configs, $exchange_rate);
       /*/receive exchange rates*/

        if (!empty($rows_from_file)) {
           
            foreach ($rows_from_file as $row) {
                if (empty($row->bin)) {
                    $result["error"][] = "bin is empty";
                } else {
                    ///4745030
                    
                    //if ($row->bin == "4745030") {
                    //if ($row->bin == "45717360") {

                    /*receive bin*/
                    $api_connection_bin = $api_connection->getCountryCardByBin($row->bin);
              
                    $bin_provider = BinFactory::create($this->dto_configs->bin_url_type);
                 
                    $currency_state_name = $bin_provider->getStateName($api_connection_bin);
                    //print_r($api_connection_bin);
                 
                    $is_euro_bank_card = Helper::isEuroBankCardEmitted($currency_state_name, $this->dto_configs->const_currency_list);
                    /*receive bin*/

                    $commission[] = $calculation->getCommissionByZone($row, $currency_state_name, $is_euro_bank_card).PHP_EOL;
        

                    //}
                }
            }
        } else {
            $result["error"][] = "file is empty";
        }
        if (count($commission) > 0) {
            $result["success"] = $commission;
        }
             
        return $result;
    }
}