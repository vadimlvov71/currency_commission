<?php

namespace App\Interface;
 

interface ExchangeProvidersInterface
{

    public function getExchangeRates($api_connection_result);
   
}
