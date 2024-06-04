<?php
namespace App\Provider\ExchangeProvider;

use App\Interface\ExchangeProvidersInterface;

class FrankfurtProvider implements ExchangeProvidersInterface
{
    public function getExchangeRates($api_connection_result)
    {
        $rates = [];
        $rates["exchange_access_error"] = true;
        //$rates["api_connection_result"] = $api_connection_result;
        //$rows = json_decode($api_connection_result["content"], true);
        
        $rows = (array) $api_connection_result["rates"];
       /* if ($rows) {
            $rates = $rows["rates"];
        }*/
   
        return $rows;       
    }
}